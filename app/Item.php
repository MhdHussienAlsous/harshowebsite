<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Item extends Model
{
	use Translatable;

	public $translatedAttributes = ['title' , 'body' , 'created_at' , 'introduction'];

    protected $fillable = [
    	 'category_id' , 'image', 
    ];

    public $timestamps = false;
    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // many to many relationship between item and fields 
    public function fields(){
        return $this->belongsToMany('App\ItemField' , 'custom_fields' , 'item_id' , 'field_id')->withPivot('value');
    }

    // many to many relationship between item and tags 
    public function tags(){
        return $this->belongsToMany('App\Tag' , 'item_tag' , 'item_id' , 'tag_id');
    }

    public function person(){
        return $this->belongsTo(Person::class , 'person_id');
    }

    public function files(){
        return $this->hasMany(ItemFile::class);
    }
}
