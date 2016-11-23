<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = ['name','uuid'];

    public function questions()
    {
        return $this->belongsToMany('App\Question')->withTimestamps();
    }
}
