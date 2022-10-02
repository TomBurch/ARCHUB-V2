<?php

namespace App\Http\Controllers;

use App\Models\Operation;
use App\Models\OperationMission;

use Illuminate\Http\Request;

class OperationController extends Controller
{
    public function update(Request $request, Operation $operation)
    {
        $this->authorize('manage-operations');

        $play_order = $request->input('play_order');
        $mission_id = $request->input('mission_id');

        OperationMission::updateOrCreate(
            [
                'operation_id' => $operation->id,
                'play_order' => $play_order
            ],
            [
                'mission_id' => $mission_id
            ]
        );
    }
}
