<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DivanType extends Model
{
    public function divan()
    {
        return $this->hasMany(Divan::class);
    }
}
