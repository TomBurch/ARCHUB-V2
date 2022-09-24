<?php

namespace App\Models\Missions;

use App\Models\Map;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Mission extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory, Notifiable;

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

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function map()
    {
        return $this->belongsTo(Map::class);
    }

    public function comments()
    {
        return $this->hasMany(MissionComment::class)->orderBy('created_at', 'DESC');
    }

    public function notes()
    {
        return $this->hasMany(MissionNote::class)->orderBy('created_at', 'DESC');
    }

    public function revisions()
    {
        return $this->hasMany(MissionRevision::class);
    }

    public function url()
    {
        return url("hub/missions/{$this->id}");
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 384, 384)
            ->nonQueued()
            ->performOnCollections('media');
    }

    public function photos()
    {
        return $this->getMedia('media');
    }
}