<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Place extends Model
{
    protected $fillable = ['name', 'state_id', 'address', 'image'];

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /*public function setImageAttribute($image)
    {
        if(!empty($image)) {
            $name = Carbon::now()->second . $image->getClientOriginalName();
            $this->attributes['image'] = 'uploads/' . $name;
            Storage::disk('uploads')->put($name, File::get($image));
        }
    }*/

    public function scopeSearch($query, $search) {
        $value = '%' . $search . '%';

        return $query
            ->where('id', 'like', $value)
            ->orWhere('name', 'like', $value);
    }
}
