<?php

namespace App\Http\Controllers;

use App\Models\Missions\Mission;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MissionMediaController extends Controller
{
    public function store(Request $request, Mission $mission)
    {
        $this->authorize('manage-media', $mission);

        $mission
            ->addMedia($request->file('media'))
            ->withCustomProperties(['user_id' => auth()->user()->id])
            ->toMediaCollection('images');

        if (!$mission->thumbnail) {
            $mission->thumbnail = $mission->photos()->first()->getUrl('thumb');
            $mission->save();
        }
    }

    public function delete(Request $request, Mission $mission, Media $media)
    {
        $this->authorize('manage-media', $mission);

        if ($mission->thumbnail == $media->getUrl('thumb')) {
            $mission->thumbnail = null;
            $mission->save();
        }
        $media->delete();
    }

    public function setThumbnail(Request $request, Mission $mission, Media $media)
    {
        $this->authorize('manage-media', $mission);

        $mission->thumbnail = $media->getUrl('thumb');
        $mission->save();
    }
}
