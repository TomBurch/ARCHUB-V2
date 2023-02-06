<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applications\JoinRequest;
use App\Models\Applications\JoinStatus;
use Illuminate\Support\Facades\DB;

class ApplicationsController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view-applications');

        $statuses = JoinRequest::with('status:id,text')
        ->select('status_id', DB::raw('count(*) as total'))
        ->groupBy('status_id')
        ->get();

        $status_text = $request->input('status');
        if (is_null($status_text)) {
            $applications = [];
        } else {
            $status = JoinStatus::select('id')->where('text', $status_text)->first();
            $applications = JoinRequest::select('id', 'created_at', 'name', 'age', 'location') //'email', 'steam', 'discord', 'available', 'experience', 'bio', 'source_id', 'source_text', 'status_id')
            ->where('status_id', $status->id)
            ->orderBy('created_at', 'desc')
            ->get();
        }

        return inertia('Hub/Applications/Applications', [
            'statuses' => $statuses,
            'applications' => $applications,
        ]);
    }
}
