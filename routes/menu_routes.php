<?php


/*
|--------------------------------------------------------------------------
| Menu Routes
|--------------------------------------------------------------------------
*/



    // add menu page
	Route::get('/add-menu',  'MenuController@addMenu');

	// add menu into DB
    Route::post('/add-menuDB',  'MenuController@addmenuDB');

    // all menus page
	Route::get('/all-menus',  'MenuController@allMenus');

    // delete menu
    Route::get('all-menus/{menu}/delete',  'MenuController@deleteMenu');

    // show edit menu page
    Route::get('menu/{menu}/edit',  'MenuController@editMenu');
    Route::post('menu/{menu}/update',  'MenuController@updateMenu');




