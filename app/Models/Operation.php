<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    public function missions()
    {
        return $this->hasMany(OperationMission::class)->orderBy('play_order');
    }
}
