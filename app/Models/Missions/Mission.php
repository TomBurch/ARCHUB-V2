<?php

namespace App\Models\Missions;

use App\Models\Map;
use App\Models\Missions\Tags\MissionTag;
use App\Models\OperationMission;
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
        'file_name',
        'orbatSettings',
        'slottingDetails',
        'maintainer_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function maintainer()
    {
        return $this->belongsTo(User::class, 'maintainer_id');
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function map()
    {
        return $this->belongsTo(Map::class);
    }

    public function operations()
    {
        return $this->hasMany(OperationMission::class);
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

    public function subscribers()
    {
        return $this->hasMany(MissionSubscription::class);
    }

    public function briefing_models()
    {
        return $this->hasMany(MissionBriefing::class);
    }

    public function tags()
    {
        return $this->hasMany(MissionTag::class);
    }

    public function url()
    {
        return "https://arcomm.co.uk/hub/missions/{$this->id}";
        //return url("hub/missions/{$this->id}");
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 384, 384)
            ->nonQueued()
            ->performOnCollections('images');
    }

    public function photos()
    {
        return $this->getMedia('images');
    }
}
