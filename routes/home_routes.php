<?php


/*
|--------------------------------------------------------------------------
| Home Routes
|--------------------------------------------------------------------------
*/

// Home page
Route::get('/',  'HomeController@homePage');

Route::post('/',  'HomeController@setLanguage');

Route::get('/section/{id}',  'HomeController@menuPage');

Route::get('cat/{id}',  'HomeController@catPage');

Route::get('item/{item}',  'HomeController@itemPage');


