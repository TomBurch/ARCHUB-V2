<?php

namespace App\Http\Controllers;

use App\Models\Missions\Mission;

class AppController extends Controller
{
    public function index()
    {
        $missions = Mission::with([
            'user:id,username',
            'map:id,display_name',
        ])
            ->select('id', 'user_id', 'map_id', 'display_name', 'mode', 'summary', 'thumbnail')
            ->whereIn('id', [46, 47, 48])
            ->get()->toArray();

        return inertia('Public/App', [
            'missions' => $missions,
        ]);
    }
}
