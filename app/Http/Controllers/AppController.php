<?php

namespace App\Http\Controllers;

use App\Models\Missions\Mission;
use Illuminate\Support\Facades\Storage;

class AppController extends Controller
{
    public function index()
    {
        $missions = Mission::with([
            'user:id,username',
            'map:id,display_name',
        ])
            ->select('id', 'user_id', 'map_id', 'display_name', 'mode', 'summary', 'verified_by', 'thumbnail')
            ->whereIn('id', [1194, 859, 1084])
            ->get()->toArray();

        $banners = Storage::disk('images')->allFiles('banners');
        $banners = collect($banners)->map(function ($file) {
            return url('images/'.$file);
        });

        return inertia('Public/App', [
            'missions' => $missions,
            'banners' => $banners,
        ]);
    }
}
