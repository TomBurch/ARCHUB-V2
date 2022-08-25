<?php

namespace App\Http\Controllers;

use App\Models\Mission;

use Inertia\Inertia;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function index(Mission $mission)
    {
        $mission = Mission::with('user:id,username')->select('id', 'user_id', 'display_name', 'mode', 'summary')->firstWhere('id', $mission->id)->toArray();
        return inertia('Hub/Missions/Mission', [
            'mission' => $mission,
        ]);
    }
}
