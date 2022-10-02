<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $fillable = [
        'starts_at'
    ];

    public function missions()
    {
        return $this->hasMany(OperationMission::class)->orderBy('play_order');
    }
}
