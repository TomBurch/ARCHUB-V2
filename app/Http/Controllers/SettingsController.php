<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return inertia('Hub/User/Settings', [
            'avatar' => auth()->user()->avatar,
        ]);
    }
}
