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
    }

    public function delete(Request $request, Mission $mission, Media $media)
    {
        $this->authorize('manage-media', $mission);

        $media->delete();
    }
}
