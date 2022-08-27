<?php

namespace App\Http\Controllers;

use App\Models\Mission;

use Inertia\Inertia;
use Illuminate\Http\Request;

class MissionsController extends Controller
{
    public function index()
    {
        $missions = Mission::with('user:id,username')
        ->select('id', 'user_id', 'display_name', 'mode', 'summary')
        ->orderBy('id', 'desc')->get()->toArray();

        $user_id = auth()->user()->id;
        $my_missions = array_filter($missions, function($v) use ($user_id) {
            return $v['user_id'] == $user_id;
        });

        return inertia('Hub/Missions/Missions', [
            'missions' => $missions,
            'my_missions' => $my_missions
        ]);
    }
}
