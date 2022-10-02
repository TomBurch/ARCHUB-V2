<?php

namespace App\Http\Controllers;

use App\Models\Missions\Mission;
use App\Models\Operation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class MissionsController extends Controller
{
    public function index()
    {
        $missions = Mission::with('user:id,username')
            ->select('id', 'user_id', 'display_name', 'mode', 'summary', 'verified_by', 'last_played')
            ->orderBy('last_played', 'desc')
            ->orderBy('id', 'desc')
            ->get()->toArray();

        $next_operation = Operation::with([
            'missions:operation_id,mission_id,play_order' => [
                'mission:id,user_id,display_name,mode,summary,verified_by' => [
                    'user:id,username'
                ]
            ]
        ])->where('starts_at', '>', Carbon::now()->subHours(3)->toDateTimeString())
            ->orderBy('starts_at', 'asc')
            ->first();

        if (is_null($next_operation)) {
            $next_operation = Operation::create([
                'starts_at' => Carbon::parse('next saturday')->hour(18)
            ]);
            $next_operation->missions = array();
        }

        return inertia('Hub/Missions/Missions', [
            'missions' => $missions,
            'next_operation' => $next_operation,
            'can' => [
                'test_missions' => Gate::allows('test-missions'),
                'manage_operations' => Gate::allows('manage-operations'),
            ]
        ]);
    }
}
