<?php

namespace App\Models;

use App\Models\User;
use App\Models\Mission;

use Illuminate\Database\Eloquent\Model;

class MissionNote extends Model
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

    /**
     * Gets the author of the comment.
     *
     * @return App\Models\Portal\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Gets the mission the comment belongs to.
     *
     * @return App\Models\Missions\Mission
     */
    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }
}
