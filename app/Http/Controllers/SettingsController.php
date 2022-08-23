<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        Inertia::share('user', fn (Request $request) => $request->user()
            ? $request->user()->only('username')
            : null
        );

        return inertia('Settings', [
            'user' => auth()->user(),
        ]);
    }
}
