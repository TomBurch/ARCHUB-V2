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
            'next_operation' => $next_operation,
            'can' => [
                'test_missions' => Gate::allows('test-missions'),
            ]
        ]);
    }
}
