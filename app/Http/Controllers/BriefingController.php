<?php

namespace App\Http\Controllers;

use App\Models\Missions\Mission;
use App\Models\Missions\MissionBriefing;
use Illuminate\Http\Request;

class BriefingController extends Controller
{
    public function update(Request $request, Mission $mission, MissionBriefing $briefing)
    {
        $this->authorize('lock-briefings', $mission);
        $locked = $request->input('locked');

        $briefing->locked = $locked;
        $briefing->save();
    }
}
