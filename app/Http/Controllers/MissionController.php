<?php

namespace App\Http\Controllers;

use App\Discord;
use App\Helpers\PBOMission\PBOMission;
use App\Models\Map;
use App\Models\Missions\Mission;
use App\Models\Missions\MissionRevision;
use Carbon\Carbon;
use \stdClass;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class MissionController extends Controller
{
    public function index(Mission $mission)
    {
        $canTestMission = Gate::allows('test-mission', $mission);

        $mission = Mission::with([
            'user:id,username',
            'comments:id,mission_id,user_id,text,published,created_at' => [
                'user:id,username,avatar'
            ],
        ])
            ->when($canTestMission, function ($query) {
                return $query->with([
                    'notes:id,mission_id,user_id,text,published,created_at' => [
                        'user:id,username,avatar'
                    ],
                    'verifier:id,username'
                ]);
            })
            ->select('id', 'user_id', 'display_name', 'mode', 'verified_by', 'summary', 'briefings')
            ->firstWhere('id', $mission->id);

        $media = $mission->photos()->map(function ($value) {
            return $value->getUrl('thumb');
        });

        $missionArray = $mission->toArray();

        array_walk($missionArray['comments'], function (&$comment) {
            $note['created_at'] = Carbon::parse($comment['created_at'])->diffForHumans();
        });

        if ($canTestMission) {
            array_walk($missionArray['notes'], function (&$note) {
                $note['created_at'] = Carbon::parse($note['created_at'])->diffForHumans();
            });
        }

        return inertia('Hub/Missions/Mission', [
            'mission' => $missionArray,
            'mission.media' => $media,
            'can' => [
                'test_mission' => $canTestMission,
                'verify_missions' => Gate::allows('verify-missions'),
            ]
        ]);
    }

    public function patch(Request $request, Mission $mission)
    {
        $verified_by = $request->input('verified_by', false);

        if ($verified_by !== false) {
            $mission->verified_by = is_null($verified_by) ? null : $verified_by["id"];
            $mission->save();

            if (!is_null($verified_by)) {
                $username = $verified_by['username'];
                Discord::missionUpdate("Verified by **{$username}**", $mission, true);
            }
        }
    }

    public function store(Request $request)
    {
        $mission = $this->uploadMission($request);

        Discord::missionUpdate("New mission by **{$mission->user->username}**", $mission, false);
    }

    public function update(Request $request, Mission $mission)
    {
        $mission = $this->uploadMission($request, $mission);

        Discord::missionUpdate("Updated by **{$mission->user->username}**", $mission, false);
    }

    public function uploadMission(Request $request, Mission $mission = null)
    {
        $isNewMission = is_null($mission);

        $missionFile = $request->file('mission');
        $fileName = $missionFile->getClientOriginalName();
        $user = auth()->user();

        // Temporarily store locally
        $path = $missionFile->storeAs(
            "missions/{$user->id}",
            $fileName
        );

        $contents = $this->getMissionContents($path);
        $details = $this->getDetailsFromFilePath($fileName);
        $briefings = $this->parseBriefings($contents['mission']['briefings']);

        if ($isNewMission) {
            $mission = Mission::create([
                'user_id' => $user->id,
                'display_name' => $contents['mission']['name'],
                'mode' => $details->mode,
                'summary' => $contents['mission']['description'],
                'briefings' => json_encode($briefings),
                'map_id' => $details->map->id,
            ]);
        } else {
            $mission->display_name = $contents['mission']['name'];
            $mission->mode = $details->mode;
            $mission->summary = $contents['mission']['description'];
            $mission->briefings = json_encode($briefings);
            $mission->map_id = $details->map->id;
            $mission->save();

            MissionRevision::create([
                'mission_id' => $mission->id,
                'user_id' => $user->id
            ]);
        }

        $revisions = $mission->revisions()->count();
        $exportedName = "{$details->filenameNoMap}_{$revisions}.{$details->map->class_name}.pbo";
        $pboPath = "missions/{$mission->user_id}/{$mission->id}/{$exportedName}";

        if (!$isNewMission) {
            Storage::cloud()->delete($mission->cloud_pbo);
        }

        Storage::cloud()->put(
            $pboPath,
            file_get_contents(storage_path("app/{$path}"))
        );

        $mission->cloud_pbo = $pboPath;
        $mission->save();

        return $mission;
    }

    public function download(Mission $mission)
    {
        $url = Storage::cloud()->temporaryUrl($mission->cloud_pbo, now()->addMinutes(10));
        return Inertia::location($url);
    }

    private function getMissionContents(string $path)
    {
        $mission = new PBOMission(storage_path("app/{$path}"));
        $contents = $mission->export();

        if ($mission->error) {
            return new Exception($mission->errorReason);
        }

        return $contents;
    }

    private function getDetailsFromFilePath($path)
    {
        $filename = pathinfo($path, PATHINFO_FILENAME);
        $mapName = pathinfo($filename, PATHINFO_EXTENSION);
        $filenameNoMap = pathinfo($filename, PATHINFO_FILENAME);
        $mode = strtolower(explode('_', $filenameNoMap)[1]);

        $map = Map::firstOrCreate(
            ['class_name' => $mapName],
            ['display_name' => $mapName],
        );

        $details = new stdClass();
        $details->mode = $mode;
        $details->map = $map;
        $details->filenameNoMap = $filenameNoMap;

        return $details;
    }

    private function parseBriefings($briefings)
    {
        foreach ($briefings as $key => $briefing) {
            preg_match_all("~\"diary\", [\S\s]+?(?=\]\s*\]\s*;)~", $briefing[3], $diaryMatches);

            $dict = array();
            $diaries = $diaryMatches[0];

            foreach ($diaries as $diary) {
                preg_match_all("~\"([^\"]+)\"~", $diary, $quotes);
                $dict[$quotes[1][1]] = $quotes[1][2];
            }

            $briefings[$key][3] = (array)$dict;
        }

        return $briefings;
    }
}
