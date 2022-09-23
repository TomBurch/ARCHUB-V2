<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Operation;
use Carbon\Carbon;

class MissionsController extends Controller
{
    public function index()
    {
        $missions = Mission::with('user:id,username')
            ->select('id', 'user_id', 'display_name', 'mode', 'summary')
            ->orderBy('id', 'desc')->get()->toArray();

        $user_id = auth()->user()->id;
        $my_missions = array_filter($missions, function ($v) use ($user_id) {
            return $v['user_id'] == $user_id;
        });

        $next_operation = Operation::with([
            'missions:operation_id,mission_id' => [
                'mission:id,user_id,display_name,mode,summary' => [
                    'user:id,username'
                ]
            ]
        ])->where('starts_at', '>', Carbon::now()->subHours(3)->toDateTimeString())
            ->orderBy('starts_at', 'asc')
            ->first();

        return inertia('Hub/Missions/Missions', [
            'missions' => $missions,
            'my_missions' => $my_missions,
            'next_operation' => $next_operation,
        ]);
    }
}
