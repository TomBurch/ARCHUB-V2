<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Faker\Factory;

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

    public function store(Request $request)
    {
        $missionFile = $request->file('mission');
        $user = auth()->user();

        $faker = Factory::create();
        $mission = Mission::create([
            'user_id' => $user->id,
            'display_name' => $missionFile->getClientOriginalName(),
            'mode' => 'coop',
            'summary' => $faker->catchPhrase(),
        ]);
    }
}
