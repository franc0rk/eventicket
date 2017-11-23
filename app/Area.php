<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = ['name', 'place_id', 'capacity'];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function scopeSearch($query, $search) {
        $value = '%' . $search . '%';

        return $query
            ->where('id', 'like', $value)
            ->orWhere('name', 'like', $value)
            ->orWhere('capacity', 'like', $value);
    }
}
