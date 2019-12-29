<?php // Code within app\Helpers\Helper.php

namespace App\Helper;
use App\Dictionary;

class Helper
{


    public static function setWord($word)
    {
    	$keywords = Dictionary::all();
        foreach ($keywords as $keyword) {
            if(strcmp(str_replace(' ', '', $keyword->key) ,str_replace(' ', '', $word)) == 0)
            {
                return  $keyword->name;
            } 
        }
        return "not found";
    }
}