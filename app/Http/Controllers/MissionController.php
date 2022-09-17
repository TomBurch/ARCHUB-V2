<?php

namespace App\Http\Controllers;

use App\Helpers\PBOMission\PBOMission;
use App\Models\Mission;

use \stdClass;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MissionController extends Controller
{
    public function index(Mission $mission)
    {
        $mission = Mission::with([
            'user:id,username',
        ])
        ->when(Gate::allows('test-mission', $mission), function ($query) {
            return $query->with([
                'comments:id,mission_id,user_id,text' => [
                    'user:id,username,avatar'
                ],
                'notes:id,mission_id,user_id,text' => [
                    'user:id,username,avatar'
                ]
            ]);
        })
        ->select('id', 'user_id', 'display_name', 'mode', 'summary', 'briefings')
        ->firstWhere('id', $mission->id)->toArray();
        
        return inertia('Hub/Missions/Mission', [
            'mission' => $mission,
        ]);
    }

    public function store(Request $request)
    {
        $missionFile = $request->file('mission');
        $fileName = $missionFile->getClientOriginalName();
        $user = auth()->user();

        // Temporarily store locally
        $path = $missionFile->storeAs(
            "missions/{$user->id}",
            $fileName
        );

        $contents = $this->getMissionContents($path);
        $details = $this->getDetailsFromFileName($fileName);
        $briefings = $this->parseBriefings($contents['mission']['briefings']);
        
        $mission = Mission::create([
            'user_id' => $user->id,
            'display_name' => $contents['mission']['name'],
            'mode' => $details->mode,
            'summary' => $contents['mission']['description'],
            'briefings' => json_encode($briefings),
        ]);
    }

    private function getMissionContents(string $path) {
        $mission = new PBOMission(storage_path("app/{$path}"));
        $contents = $mission->export();

        // if ($mission->error) {
        //     return new Exception($mission->errorReason);
        // }

        return $contents;
    }

    private function getDetailsFromFileName($name) {
        $name = substr($name, 0, -4);
        $mapName = last(explode('.', $name));
        $parts = explode('_', rtrim($name, ".{$mapName}"));
        $mode = strtolower($parts[1]);

        $details = new stdClass();
        $details->mode = $mode;
        $details->map = $mapName;

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
