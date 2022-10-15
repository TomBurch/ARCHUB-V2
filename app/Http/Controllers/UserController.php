<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return User::selectRaw('username as label, id as value')
            ->orderBy('username')
            ->get()->toArray();
    }
}
