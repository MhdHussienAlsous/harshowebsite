<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    public function phoneGallary()
    {
        return $this->hasMany(PhoneGallary::class);
    }

    public function phoneLog()
    {
        return $this->hasMany(PhoneLog::class);
    }
    

}
