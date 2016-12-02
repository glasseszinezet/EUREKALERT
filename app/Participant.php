<?php

namespace App;

use App\Http\Controllers\UserRequestController;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected  $fillable = ['first_name','last_name','other_name','location','msisdn','fb_id','gender','email','occupation'];

    public function setMsisdnAttribute($phone)
    {
        $this->attributes['msisdn'] = UserRequestController::formatMSISDN($phone);
    }

}
