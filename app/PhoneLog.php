<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneLog extends Model
{
    public function phoneNumber(){
        return $this->belongsTo(PhoneNumber::class , 'phone_number_id');
    }

    public function person(){
        return $this->belongsTo(Person::class , 'person_id');
    }

}
