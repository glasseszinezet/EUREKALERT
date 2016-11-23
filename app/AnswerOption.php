<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnswerOption extends Model
{
    protected $fillable = ['text'];

    public function question()
    {
        return $this->belongsToMany('App\Question')->withTimestamps();
    }
}
