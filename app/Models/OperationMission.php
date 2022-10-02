<?php

namespace App\Models;

use App\Models\Missions\Mission;
use Illuminate\Database\Eloquent\Model;

class OperationMission extends Model
{
    protected $fillable = [
        'operation_id',
        'mission_id',
        'play_order',
    ];

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    public function operation()
    {
        return $this->belongsTo(Operation::class);
    }
}
