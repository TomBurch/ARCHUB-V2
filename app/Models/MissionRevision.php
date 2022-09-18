<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissionRevision extends Model
{
    protected $fillable = [
        'mission_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }
}
