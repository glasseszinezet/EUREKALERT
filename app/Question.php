<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['text'];

    public function campaign()
    {
        return $this->belongsToMany('App\Campaign');
    }

    public function answerOptions()
    {
        return $this->belongsToMany('App\AnswerOption');
    }
}
