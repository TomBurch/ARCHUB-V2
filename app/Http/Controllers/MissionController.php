<?php

namespace App\Http\Controllers;

use App\Discord;
use App\Helpers\PBOMission\PBOMission;
use App\Models\Map;
use App\Models\Missions\Mission;
use App\Models\Missions\MissionBriefing;
use App\Models\Missions\MissionRevision;

use \stdClass;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class MissionController extends Controller
{
    /**
     * Side represented as an integer as used by TMF_OrbatSettings
     * From: https://community.bistudio.com/wiki/BIS_fnc_sideID
     *
     * @var array
     */
    public static $sideMap = [
        "opfor" => 0,
        "east" => 0,
        "blufor" => 1,
        "west" => 1,
        "independent" => 2,
        "resistance" => 2,
        "civilian" => 3
    ];

    public function index(Mission $mission)
    {
        $this->authorize('view-mission', $mission);

        $canTestMission = Gate::allows('test-mission', $mission);

        $mission = Mission::with([
            'user:id,username',
            'map:id,display_name',
            'maintainer:id,username',
            'briefing_models:id,mission_id,name,sections,locked',
            'comments:id,mission_id,user_id,text,published,created_at' => [
                'user:id,username,avatar'
            ],
            'tags:id,mission_id,tag_id' => [
                'tag:id,name'
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
            ->select('id', 'user_id', 'map_id', 'display_name', 'mode', 'verified_by', 'summary', 'orbats', 'orbatSettings', 'slottingDetails', 'maintainer_id', 'thumbnail')
            ->firstWhere('id', $mission->id);

        $media = [];
        foreach ($mission->photos() as $photo) {
            $media[$photo->id] = [
                'url' => $photo->getUrl(),
                'width' => $photo->getCustomProperty('width'),
                'height' => $photo->getCustomProperty('height'),
            ];
        };

        $missionArray = $mission->toArray();

        $missionArray['briefing_models'] = array_filter($missionArray['briefing_models'], function ($briefing) use ($canTestMission) {
            return (!$briefing['locked']) || $canTestMission;
        });

        foreach ($missionArray['briefing_models'] as &$briefing) {
            foreach ($briefing['sections'] as &$section) {
                $section = $this->replaceFontTags($section);
            }
        }

        $missionArray['orbatSettings'] = json_decode($missionArray['orbatSettings']);

        return inertia('Hub/Missions/Mission', [
            'mission' => $missionArray,
            'mission.media' => $media,
            'can' => [
                'test_mission' => $canTestMission,
                'verify_missions' => Gate::allows('verify-missions'),
                'delete_mission' => Gate::allows('delete-mission', $mission),
                'update_mission' => Gate::allows('update-mission', $mission),
                'set_maintainers' => Gate::allows('set-maintainers'),
                'assign_tags' => Gate::allows('assign-tags', $mission),
                'manage_tags' => Gate::allows('manage-tags'),
                'manage_media' => Gate::allows('manage-media', $mission),
            ]
        ]);
    }

    public function patch(Request $request, Mission $mission)
    {
        $this->authorize('verify-missions');

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

    public function delete(Request $request, Mission $mission)
    {
        $this->authorize('delete-mission', $mission);

        $mission->delete();
    }

    public function store(Request $request)
    {
        $mission = $this->uploadMission($request);

        Discord::missionUpdate("New mission by **{$mission->user->username}**", $mission, false);
    }

    public function update(Request $request, Mission $mission)
    {
        $this->authorize('update-mission', $mission);
        
        $mission = $this->uploadMission($request, $mission);
        Discord::missionUpdate("Updated by **{$request->user()->username}**", $mission, false);
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

        try {
            //====== Old orbat generation for Archub V1 compatibility ======//
            $orbatSettings = json_encode($this->orbatFromOrbatSettings($contents['mission']['orbatSettings'], $contents['mission']['groups']));
        } catch (Exception $e) {
            $orbatSettings = json_encode(array("Error extracting ORBAT:" => array($e->getMessage())));
        }

        $orbats = $this->generateOrbats($contents['mission']['orbatSettings'], $contents['mission']['groups']);
        $summary = array_key_exists('description', $contents['mission']) ? $contents['mission']['description'] : "";

        if ($isNewMission) {
            $mission = Mission::create([
                'user_id' => $user->id,
                'display_name' => $contents['mission']['name'],
                'mode' => $details->mode,
                'summary' => $summary,
                'briefings' => json_encode($briefings),
                'map_id' => $details->map->id,
                'file_name' => $fileName,
                'orbatSettings' => $orbatSettings,
                'orbats' => $orbats,
                'slottingDetails' => $contents['mission']['slottingDetails'],
            ]);
        } else {
            $mission->display_name = $contents['mission']['name'];
            $mission->mode = $details->mode;
            $mission->summary = $summary;
            $mission->briefings = json_encode($briefings);
            $mission->map_id = $details->map->id;
            $mission->file_name = $fileName;
            $mission->orbatSettings = $orbatSettings;
            $mission->orbats = $orbats;
            $mission->slottingDetails = $contents['mission']['slottingDetails'];
            $mission->save();

            MissionRevision::create([
                'mission_id' => $mission->id,
                'user_id' => $user->id
            ]);
        }

        $this->storeBriefings($mission, $briefings);

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

        // Delete local temp files
        Storage::deleteDirectory("missions/{$user->id}");

        return $mission;
    }

    public function download(Mission $mission)
    {
        $this->authorize('test-mission', $mission);

        $url = Storage::cloud()->temporaryUrl($mission->cloud_pbo, now()->addMinutes(10));
        return Inertia::location($url);
    }

    /**
     * Deploy mission .pbo to arma server
     * Uses https://github.com/Dahlgren/arma-server-web-admin/blob/master/routes/missions.js
     */
    public function deploy(Mission $mission)
    {
        $this->authorize('verify-missions');

        $url = config('services.missions.url');
        $headers = [
            'Authorization' => "Basic " .
                base64_encode(config('services.missions.user') . ":" . config('services.missions.pass'))
        ];
        $userId = auth()->user()->id;

        $details = $this->getDetailsFromFilePath($mission->file_name);
        $revisions = $mission->revisions()->count();
        $exportedName = "{$details->filenameNoMap}_{$revisions}.{$details->map->class_name}.pbo";

        // Temp download .pbo locally
        Storage::put(
            "mission_deploy/{$userId}/{$mission->id}/{$exportedName}",
            Storage::cloud()->get($mission->cloud_pbo)
        );

        // Deploy .pbo to arma server
        $response = HTTP::withHeaders($headers)->attach(
            'missions',
            file_get_contents(storage_path("app/mission_deploy/{$userId}/{$mission->id}/{$exportedName}")),
            $exportedName
        )->post($url);

        // Refresh server mission list
        HTTP::withHeaders($headers)->post("{$url}/refresh");

        // Delete local temp files
        Storage::deleteDirectory("mission_deploy/{$userId}");
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

    private function replaceFontTags($section) {
        return preg_replace_callback(
            "~<font (.*?)>(.*?)<\/font>~",
            function($matches) {
                $modifiers = array();
                preg_match_all("~([a-z]+)='(.*?)'~", $matches[1], $modifiers, PREG_SET_ORDER);
                
                $style = "";
                foreach ($modifiers as $modifier) {
                    $key = $modifier[1];
                    $value = $modifier[2];
                    
                    switch($key) {
                        case "size":
                            $fontSize = (((int)$value) * 2) - 5;
                            $style .= "font-size:{$fontSize}px;"; 
                            break;
                        case "color":
                            $style .= "color:{$value};";
                            break;
                        case "face":
                            $style .= "font-family:{$value};";
                            break;
                    }
                }
                return "<p style='display:inline-block;{$style}'>{$matches[2]}</p>";
            },
            $section
        );
    }

    public function storeBriefings($mission, $briefingsArray)
    {
        if (is_null($briefingsArray)) {
            return;
        }

        $names = [];
        $briefings = [];
        foreach ($briefingsArray as $briefing) {
            array_push($names, $briefing[0]);
            array_push($briefings, [
                'mission_id' => $mission->id,
                'name' => $briefing[0],
                'sections' => json_encode($briefing[3]),
            ]);
        }

        MissionBriefing::where('mission_id', $mission->id)
            ->whereNotIn('name', $names)
            ->delete();

        MissionBriefing::upsert(
            $briefings,
            ['mission_id', 'name'],
            ['sections']
        );
    }

    private function generateOrbats(array $orbatSettings, array $groups) {
        $orbats = array();

        foreach ($orbatSettings as $settings) {
            $factionId = $settings[0];
            $rootCategory = $this->expandCategory($settings[1]);

            $orbats[$factionId] = $rootCategory;
        }

        foreach ($groups as $group) {
            $factionId = self::$sideMap[$group['side']];

            if (isset($group['orbatParent'])) {
                if ($group['orbatParent'] == -1) {
                    $group['orbatParent'] = 0;
                }

                $this->insertGroupIntoCategory($group, $orbats[$factionId]);
            }
        }

        $namedOrbats = array();
        foreach ($orbats as $factionId => &$orbat) {
            $this->removeEmptyCategories($orbat);

            if (!is_null($orbat)) {
                $factionName = array_search($factionId, self::$sideMap);
                $namedOrbats[$factionName] = $orbat;
            }
        }

        return $namedOrbats;
    }

    private function expandCategory(array $category) {
        $details = $category[0];
        $subcategories = $category[1];

        $outCategory = array(
            "id" => $details[0],
            "name" => $details[4],
            "groups" => array(),
            "subcategories" => array(),
        );

        foreach($subcategories as $subcategory) {
            $expanded = $this->expandCategory($subcategory);
            array_push($outCategory["subcategories"], $expanded);
        }

        return $outCategory;
    }

    private function insertGroupIntoCategory(array $group, array &$category) {
        if ($category['id'] == $group['orbatParent']) {
            $minimalGroup = array(
                "name" => isset($group['name']) ? $group['name'] : "NOT NAMED",
                "units" => array(),
            );

            foreach($group['units'] as $unit) {
                $name = explode("@", $unit['description'])[0];
                array_push($minimalGroup['units'], $name);
            }

            array_push($category['groups'], $minimalGroup);
            return;
        } 

        foreach($category['subcategories'] as &$subcategory) {
            $this->insertGroupIntoCategory($group, $subcategory);
        }
    }

    private function removeEmptyCategories(array &$category) {
        foreach($category['subcategories'] as &$subcategory) {
            $this->removeEmptyCategories($subcategory);
        }

        $category['subcategories'] = array_filter($category['subcategories']);

        if (count($category['groups']) == 0 && count($category['subcategories']) == 0) {
            $category = null;
            return;
        }
    }


    //====== Old orbat generation for Archub V1 compatibility ======//

    /**
     * Returns a minimal version of orbatSettings for displaying on the website
     *
     * @return array
     */
    private function orbatFromOrbatSettings(array $orbats, array &$groups)
    {
        foreach ($orbats as &$faction) {
            $this->minimiseLevel($faction[1]);
            $faction = $faction[1];
        }

        $orbatGroups = array();
        foreach ($groups as &$group) {
            if (isset($group['orbatParent'])) {
                $faction = self::$sideMap[$group['side']];
                $orbatParent = $group['orbatParent'];
                $minimalGroup = array(isset($group['name']) ? $group['name'] : "NOT NAMED", array());

                foreach ($group['units'] as $unit) {
                    $desc = explode("@", $unit['description'])[0];
                    array_push($minimalGroup[1], array($desc));
                }

                if (!isset($orbatGroups[$faction])) {
                    $orbatGroups[$faction] = array();
                }

                if (!isset($orbatGroups[$faction][$orbatParent])) {
                    $orbatGroups[$faction][$orbatParent] = array($minimalGroup);
                } else {
                    array_push($orbatGroups[$faction][$orbatParent], $minimalGroup);
                }
            }
        }

        foreach ($orbats as $faction => &$orbat) {
            if (!is_array($orbat)) {
                unset($orbats[$faction]);
                continue;
            }

            $orbatModified = false;
            $this->replaceIntWithUnits($orbat[1], $faction, $orbatGroups, $orbatModified);

            if (!$orbatModified) {
                unset($orbats[$faction]);
            }
        }

        $this->removeAllIntsAndEmptyArrays($orbats);
        // Reindex array after everything has been unset
        $orbats = array_map('array_values', $orbats);

        $namedOrbats = array();
        foreach ($orbats as $faction => &$orbat) {
            $factionName = array_search($faction, self::$sideMap);
            $namedOrbats[$factionName] = &$orbat;
        }

        return $namedOrbats;
    }

    /**
     * Recursive function used by $this->orbatFromOrbatSettings()
     */
    private function minimiseLevel(array &$level)
    {
        $name = strlen($level[0][1]) > 0 ? $level[0][1] : $level[0][4]; //If an abbrievation is defined then use it, otherwise full name
        $uniqueId = $level[0][0];
        $level[0] = $name;

        if (count($level[1]) === 0) {
            $level[1] = array($uniqueId);
        } else {
            foreach ($level[1] as $i => &$subLevel) {
                $this->minimiseLevel($subLevel);
            }
            array_unshift($level[1], $uniqueId);
        }
    }

    private function replaceIntWithUnits(array &$item, int &$faction, array &$orbatGroups, bool &$orbatModified)
    {
        if (is_int($item[0])) {
            if (isset($orbatGroups[$faction][$item[0]])) {
                $units = &$orbatGroups[$faction][$item[0]];
                unset($item[0]);

                $units = array_reverse($units);

                foreach ($units as $unit) {
                    array_unshift($item, $unit);
                }
                $orbatModified = true;
            } else {
                unset($item[0]);
            }
        }

        foreach ($item as &$subitem) {
            if (is_array($subitem)) {
                $this->replaceIntWithUnits($subitem, $faction, $orbatGroups, $orbatModified);
            }
        }
    }

    private function removeAllIntsAndEmptyArrays(array &$item)
    {
        // Only have name + empty array - remove entire item
        if (isset($item[1]) && is_array($item[1]) && empty($item[1])) {
            $item = null;
            return;
        }

        // Recursively find every int and empty array and replace them will NULL
        foreach ($item as &$subitem) {
            if (is_int($subitem)) {
                $subitem = null;
            } elseif (is_array($subitem)) {
                if (empty($subitem)) {
                    $subitem = null;
                } else {
                    $this->removeAllIntsAndEmptyArrays($subitem);
                }
            }
        }

        // Double check if array is empty now that all the children have been unset
        if (isset($item[1]) && is_array($item[1]) && empty($item[1])) {
            $item = null;
            return;
        }

        // unset() used on a &reference will unset the reference but not the original value
        // instead we set everything to NULL and use array_filter, which will unset the original value
        $item = array_filter($item);
    }
}