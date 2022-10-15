<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Missions\Mission;
use App\Models\Missions\Tags\MissionTag;
use App\Models\Missions\Tags\Tag;

use Illuminate\Http\Request;

class MissionTagController extends Controller
{
    public function allTags(Request $request)
    {
        return Tag::selectRaw('name as label, id as value')
            ->orderBy('name', 'ASC')
            ->get();
    }

    public function index(Request $request, Mission $mission)
    {
        $mission_tags = MissionTag::where('mission_id', $mission->id)->get()
            ->pluck('tag_id')
            ->toArray();

        return Tag::selectRaw('name as label, id as value')
            ->whereIn('id', $mission_tags)
            ->get();
    }

    public function store(Request $request, Mission $mission)
    {
        $this->authorize('assign-tags', $mission);

        $tag = Tag::firstOrCreate(['name' => $request->tag]);
        MissionTag::firstOrCreate([
            'mission_id' => $mission->id,
            'tag_id' => $tag->id
        ]);
    }

    public function destroy(Request $request, Mission $mission, Tag $tag)
    {
        $this->authorize('assign-tags', $mission);

        MissionTag::where('mission_id', $mission->id)
            ->where('tag_id', $tag->id)
            ->delete();

        if ($request->user()->can('manage-tags')) {
            $tagUsed = MissionTag::where('tag_id', $tag->id)->first();
            if (is_null($tagUsed)) {
                $tag->delete();
            }
        }
    }
}
