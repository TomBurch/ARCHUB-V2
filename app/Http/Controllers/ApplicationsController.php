<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applications\JoinRequest;
use App\Models\Applications\JoinStatus;

class ApplicationsController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view-applications');

        $status_text = $request->input('status');
        if (is_null($status_text)) {
            $applications = [];
        } else {
            $status = JoinStatus::select('id')->where('text', $status_text)->first();
            $applications = JoinRequest::select('id', 'created_at', 'name', 'age', 'location', 'email', 'steam', 'discord', 'available', 'experience', 'bio', 'source_id', 'source_text', 'status_id')
            ->where('status_id', $status->id)
            ->orderBy('created_at', 'desc')
            ->get();
        }

        return inertia('Hub/Applications/Applications', [
            'applications' => $applications,
        ]);
    }
}
