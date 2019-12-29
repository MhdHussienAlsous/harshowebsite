<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DivanFile extends Model
{
    public function divan(){
        return $this->belongsTo(Divan::class,'divan_id');
    }
}
