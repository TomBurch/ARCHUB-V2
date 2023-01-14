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
        $missions = Mission::with([
            'user:id,username',
            'map:id,display_name',
        ])
            ->select('id', 'user_id', 'map_id', 'display_name', 'mode', 'summary', 'verified_by', 'last_played', 'thumbnail')
            ->orderBy('last_played', 'desc')
            ->orderBy('id', 'desc')
            ->get()->toArray();

        $next_operations = Operation::with([
            'missions:operation_id,mission_id,play_order' => [
                'mission:id,user_id,display_name,mode,summary,verified_by,thumbnail' => [
                    'user:id,username'
                ]
            ]
        ])->where('starts_at', '>', Carbon::now()->subHours(3)->toDateTimeString())
            ->orderBy('starts_at', 'asc')
            ->take(2)->get();

        if ($next_operations->count() < 1) {
            $next_operation = Operation::create([
                'starts_at' => Carbon::parse('next saturday')->hour(18)
            ]);
            $next_operation->missions = array();
        }

        if ($next_operations->count() < 2) {
            $next_2_operation = Operation::create([
                'starts_at' => Carbon::parse('next saturday')->addWeeks(1)->hour(18)
            ]);
            $next_2_operation->missions = array();
        } else {
            $next_operation = $next_operations[0];
            $next_2_operation = $next_operations[1];
        }

        return inertia('Hub/Missions/Missions', [
            'missions' => $missions,
            'next_operation' => $next_operation,
            'next_2_operation' => $next_2_operation,
            'can' => [
                'test_missions' => Gate::allows('test-missions'),
                'manage_operations' => Gate::allows('manage-operations'),
            ]
        ]);
    }
}
