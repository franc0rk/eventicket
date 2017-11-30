<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['user_id','event_id', 'tickets', 'area', 'total'];

    protected $dates = ['expiration'];

    public function scopeSearch($query, $search) {
        $value = '%' . $search . '%';

        return $query
            ->where('id', 'like', $value)
            ->orWhere('created_at', 'like', $value);
    }

    public function setExpirationAttribute()
    {
        $this->attributes['expiration'] = Carbon::now()->addWeeks(1);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}
