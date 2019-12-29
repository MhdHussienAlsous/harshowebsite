<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneGallary extends Model
{
    public function phoneNumber(){
        return $this->belongsTo(PhoneNumber::class , 'phone_number_id');
    }

}
