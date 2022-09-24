<?php

namespace App\Models\Missions;

use Illuminate\Database\Eloquent\Model;

class MissionSubscription extends Model
{
    protected $fillable = [
        'mission_id',
        'discord_id',
    ];

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }
}
