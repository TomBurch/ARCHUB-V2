<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class JoinController extends Controller
{
    public function index()
    {
        return inertia('Public/Join');
    }
}
