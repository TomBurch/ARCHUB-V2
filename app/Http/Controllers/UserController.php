<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return User::select('id', 'username')
            ->orderBy('username')
            ->get()->toArray();
    }
}