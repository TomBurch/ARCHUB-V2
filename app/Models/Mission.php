<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Mission extends Model
{
    use Notifiable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
