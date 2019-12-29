<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Menu extends Model
{
    use Translatable;
    
    public $translatedAttributes = ['name'];

	protected $fillable = [
    	 'parent'  , 'category_id'
    ];


        
    public function category(){
    	return $this->belongsTo(Category::class);
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent');
    }





    public function parent()
    {
        return $this->belongsTo(Menu::class);
    }

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
