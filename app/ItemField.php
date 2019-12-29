<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemField extends Model
{
	// many to many between fields and item
    public function items(){
        return $this->belongsToMany('App\Item' , 'custom_fields' , 'field_id' , 'item_id')->withPivot('value');
    }


    // one to many between category and item_fields
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
