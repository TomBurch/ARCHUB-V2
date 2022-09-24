<?php

namespace App\Http\Controllers;

use App\Models\Missions\Mission;

use Illuminate\Http\Request;

class MissionMediaController extends Controller
{
    public function store(Request $request, Mission $mission)
    {
        $mission
            ->addMedia($request->file('media'))
            ->withCustomProperties(['user_id' => auth()->user()->id])
            ->toMediaCollection('media');
    }
}
