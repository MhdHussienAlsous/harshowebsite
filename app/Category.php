<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
use DB;

class Category extends Model
{
    use Translatable;

    public $translatedAttributes = ['name', 'description'];


    protected $fillable = [
    	'parent' ,
    ];

   /* Start Relations */
    public function children()
    {
        return $this->hasMany(Category::class, 'parent');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function fields()
    {
        return $this->hasMany(ItemField::class);
    }   

   /* End Relations */
    public function getHasChildrenAttribute()
    {
        return $this->children()->count() > 0;
    }

     public function countChild()
    {
        return $this->children()->count();
    }

    public function is_root()
    {
        if($this->parent == 0)
        {
            return true;
        }
        return false;
    }


}
