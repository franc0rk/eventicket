<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['name'];

    public function scopeSearch($query, $search) {
        $value = '%' . $search . '%';

        return $query
            ->where('id', 'like', $value)
            ->orWhere('name', 'like', $value);
    }
}
