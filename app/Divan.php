<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Divan extends Model
{
    public function type(){
        return $this->belongsTo(DivanType::class,'divan_type_id');
    }

    public function person(){
        return $this->belongsTo(Person::class,'person_id');
    }

    public function divanFile()
    {
        return $this->hasMany(DivanFile::class);
    }

}
