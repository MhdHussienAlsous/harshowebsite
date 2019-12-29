<?php


/*
|--------------------------------------------------------------------------
| Tag Routes
|--------------------------------------------------------------------------
*/


// add tag page
Route::get('/add-tag',  'TagController@addTag');

// add tag into DB
Route::post('/add-tagDB',  'TagController@addTagDB');

// all tag page
Route::get('/all-tags',  'TagController@allTags');

// delete tag
Route::get('all-tags/{tag}/delete',  'TagController@deleteTag');

// show edit menu page
Route::get('tag/{tag}/edit',  'TagController@editTag');
Route::post('tag/{tag}/update',  'TagController@updateTag');




