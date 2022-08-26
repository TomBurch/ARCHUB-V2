<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Illuminate\Http\Request;

class JoinController extends Controller
{
    public function index()
    {
        return inertia('Public/Join');
    }
}
