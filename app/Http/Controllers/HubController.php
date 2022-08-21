<?php

namespace App\Http\Controllers;

use App\Models\Mission;

use Inertia\Inertia;
use Illuminate\Http\Request;

class HubController extends Controller
{
    public function index()
    {
        Inertia::share('user', fn (Request $request) => $request->user()
            ? $request->user()->only('username')
            : null
        );

        return inertia('Hub', [
            'missions' => Mission::all()->toArray(),
            //'missions' => auth()->user()->missions()->get()->toArray(), 
        ]);
    }
}
