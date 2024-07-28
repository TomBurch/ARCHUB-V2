<?php

namespace App\Models\Missions;

use App\Models\User;
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

    public function user()
    {
        return $this->belongsTo(User::class, 'discord_id', 'discord_id');
    }
}
