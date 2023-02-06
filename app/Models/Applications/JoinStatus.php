<?php

namespace App\Models\Applications;

use Illuminate\Database\Eloquent\Model;

class JoinStatus extends Model
{
    protected $fillable = [
        'text',
        'permalink',
        'position'
    ];
}
