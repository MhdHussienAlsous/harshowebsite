<?php


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

// this route to load add user page
Route::get('/add-user',  'UserController@addUser');

// this route to store user into database
Route::post('/add-user',  'UserController@storeUser');

// all users page
Route::get('/all-users',  'UserController@allUsers');

// delete user
Route::get('all-users/{user}/delete',  'UserController@deleteUser');

// show edit page
Route::get('/user/{user}/edit',  'UserController@editUser');
Route::post('/user/{user}/update',  'UserController@updateUser');




