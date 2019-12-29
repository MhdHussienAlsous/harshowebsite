<?php


/*
|--------------------------------------------------------------------------
| Category Routes
|--------------------------------------------------------------------------
*/


	// add category page
	Route::get('/add-category',  'CategoryController@addCategory');

	// add category to DB
	Route::post('/add-categoryDB',  'CategoryController@addCategoryDB');

	// all categories page
	Route::get('/all-categories',  'CategoryController@allCategories');

	// delete category
    Route::get('all-categories/{category}/delete',  'CategoryController@deleteCategory');

    // show edit category
    Route::get('category/{category}/edit/',  'CategoryController@editCategory');
    Route::post('category/{category}/update/',  'CategoryController@updateCategory');




