<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    	protected $fillable = [
    	'name'
    ];

    // broken between languages and menus
    public function menuLangs()
    {
        return $this->hasMany(menuLang::class);
    }

}
