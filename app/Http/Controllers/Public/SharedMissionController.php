<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MissionController;
use App\Models\Missions\Mission;

class SharedMissionController extends Controller
{
    public const SHARED_MISSIONS = [594, 1160, 1194];

    public function index(Mission $mission)
    {
        $this->authorize('view-shared-mission', $mission);

        $mission = Mission::with([
            'user:id,username',
            'map:id,display_name',
            'maintainer:id,username',
            'briefing_models:id,mission_id,name,sections',
            'tags:id,mission_id,tag_id' => [
                'tag:id,name'
            ],
        ])
            ->select('id', 'user_id', 'map_id', 'display_name', 'mode', 'summary', 'maintainer_id', 'thumbnail')
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

        foreach ($missionArray['briefing_models'] as &$briefing) {
            foreach ($briefing['sections'] as &$section) {
                $section = MissionController::replaceFontTags($section);
            }
        }

        return inertia('Public/Missions/SharedMission', [
            'mission' => $missionArray,
            'mission.media' => $media,
        ]);
    }
}
