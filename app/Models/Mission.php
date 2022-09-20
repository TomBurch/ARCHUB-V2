<?php

namespace App\Models;

use App\Models\MissionRevision;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Mission extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'display_name',
        'mode',
        'summary',
        'briefings',
        'map_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function map()
    {
        return $this->belongsTo(Map::class);
    }

    public function comments()
    {
        return $this->hasMany(MissionComment::class);
    }

    public function notes()
    {
        return $this->hasMany(MissionNote::class);
    }

    public function revisions()
    {
        return $this->hasMany(MissionRevision::class);
    }

    public function url()
    {
        return url("hub/missions/{$this->id}");
    }
}
