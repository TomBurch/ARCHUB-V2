<?php

namespace App\Models\Missions;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class MissionComment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text',
        'user_id',
        'mission_id',
        'published',
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
