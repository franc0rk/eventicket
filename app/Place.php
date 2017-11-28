<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $fillable = ['name', 'state_id'];

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function scopeSearch($query, $search) {
        $value = '%' . $search . '%';

        return $query
            ->where('id', 'like', $value)
            ->orWhere('name', 'like', $value)
            ->orWhere('tickets','like',$value);
    }
}
