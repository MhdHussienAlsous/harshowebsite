<?php


/*
|--------------------------------------------------------------------------
| Item Routes
|--------------------------------------------------------------------------
*/

// all item page
Route::get('/all-items',  'ItemController@allItems');
// add item page 
Route::get('/add-item',  'ItemController@addItem');

// add item into DB
Route::post('/add-itemDB',  'ItemController@storeItem');





// delete item from into
Route::get('/item/{item}/delete',  'ItemController@deleteItem');
// show edit page
Route::get('/item/{item}/edit',  'ItemController@editItem');
Route::post('/item/{item}/update',  'ItemController@updateItem');




