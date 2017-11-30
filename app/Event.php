<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    protected $fillable = [
        'event_type_id',
        'place_id',
        'name',
        'description',
        'image_cover',
        'image_thumbnail',
        'date',
        'state_id'
    ];

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    /*public function setImageThumbnailAttribute($image)
    {
        if(!empty($image)) {
            $name = Carbon::now()->second . $image->getClientOriginalName();
            $this->attributes['image_thumbnail'] = 'uploads/' . $name;
            Storage::disk('uploads')->put($name, File::get($image));
        }
    }

    public function setImageCoverAttribute($image)
    {
        if(!empty($image)) {
            $name = Carbon::now()->second . $image->getClientOriginalName();
            $this->attributes['image_cover'] = 'uploads/' . $name;
            Storage::disk('uploads')->put($name, File::get($image));
        }
    }

    public function setStateIdAttribute($place_id)
    {
        $place = Place::findOrFail($place_id);
        $this->attributes['state_id'] = $place->state_id;
    }*/

    public function scopeSearch($query, $search)
    {
        $value = '%' . $search . '%';

        return $query
            ->where('id', 'like', $value)
            ->orWhere('name', 'like', $value)
            ->orWhere('description', 'like', $value)
            ->orWhere('date','like',$value);
    }

    public function scopeByState($query, $states)
    {
        return $query->whereIn('state_id', $states);
    }

    public function scopeByEventType($query, $event_types)
    {
        return $query->whereIn('event_type_id',$event_types);
    }

    public function scopeCurrent($query)
    {
        return $query->where('date','>',Carbon::now());
    }

}
