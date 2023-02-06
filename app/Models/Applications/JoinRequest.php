<?php

namespace App\Models\Applications;

use Illuminate\Database\Eloquent\Model;

class JoinRequest extends Model
{
    protected $fillable = [
        'name',
        'age',
        'location',
        'discord',
        'steam',
        'available',
        'experience',
        'bio',
        'source_id',
        'source_text'
    ];
}
