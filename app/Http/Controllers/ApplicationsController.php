<?php

namespace App\Http\Controllers;

use App\Models\Applications\JoinRequest;

class ApplicationsController extends Controller
{
    public function index()
    {
        $applications = JoinRequest::all();
        return inertia('Hub/Applications/Applications', [
            'applications' => $applications,
        ]);
    }
}
