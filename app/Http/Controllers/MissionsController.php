<?php

namespace App\Http\Controllers;

use App\Models\Mission;

use Inertia\Inertia;
use Illuminate\Http\Request;

class MissionsController extends Controller
{
    public function index()
    {
        Inertia::share('user', fn (Request $request) => $request->user()
            ? $request->user()->only('username')
            : null
        );

        $missions = Mission::with('user:id,username')->select('id', 'user_id', 'display_name', 'mode', 'summary')->get()->toArray();
        return inertia('Missions', [
            'missions' => $missions
        ]);
    }
}
