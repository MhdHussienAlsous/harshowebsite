<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    // relationship one to one between person and user
    public function user(){
        return $this->belongsTo(User::class);
    }

    // broken between languages and menus
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    // broken between languages and menus
    public function phoneLog()
    {
        return $this->hasMany(PhoneLog::class);
    }

    public function divan()
    {
        return $this->hasMany(Divan::class);
    }

    
}
