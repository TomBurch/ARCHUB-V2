<?php

namespace App\Models\Missions\Tags;

use App\Models\Missions\Mission;

use Illuminate\Database\Eloquent\Model;

class MissionTag extends Model
{
    protected $fillable = [
        'mission_id',
        'tag_id',
    ];

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
