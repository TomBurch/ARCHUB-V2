<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperationMission extends Model
{
    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    public function operation()
    {
        return $this->belongsTo(Operation::class);
    }
}
