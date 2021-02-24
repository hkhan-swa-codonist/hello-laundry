<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'id', 'uFName','uLName', 'phone_number','email','password','profile_picture','status','otp','fcm_token'
    ];
}
