<?php

namespace App\Http\Controllers;

class SettingsController extends Controller
{
    public function index()
    {
        return inertia('Hub/User/Settings', [
            'avatar' => auth()->user()->avatar,
        ]);
    }
}
