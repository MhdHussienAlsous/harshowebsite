<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
class Dictionary extends Model
{
    use Translatable;

    public $translatedAttributes = ['name'];

      protected $fillable = [
    	'key' ,
    ];
}
