<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/add-data',function(){
// 	return view('add-data');
// });

Route::get('/uploadData',  'ItemController@uploadData');

// dashboard page
Route::get('/dashboard',  'PagesController@dashboard');

// registraion 
Route::get('/register','RegistrationController@create');
Route::post('/register','RegistrationController@store');



// login & logout
Route::get('/login','SessionsController@create')->name('login');
Route::post('/login','SessionsController@store');

// Logout
Route::get('/logout',  'SessionsController@destroy');



// template page
Route::get('/template',  'PagesController@template');
Route::post('/template',  'PagesController@setTemplate');



// PhoneController
Route::get('/add-phone'						,  'PhoneController@addPhoneNumber');
Route::post('/add-phoneDB'					,  'PhoneController@storePhone');
Route::get('/allPhones'						,  'PhoneController@allPhones');
Route::get('/phone/{phone}/delete'			,  'PhoneController@deletePhone');
Route::get('/phone/{phone}/show'			,  'PhoneController@showPhone');
Route::get('/phone/{phone}/edit'			,  'PhoneController@editPhone');
Route::post('/phone/{phone}/update'			,  'PhoneController@updatePhone');
Route::get('/phone/{phone}/add-notes'		,  'PhoneController@addPhoneNumberNote');
Route::post('/phone/{phone}/store-notes'	,  'PhoneController@storePhoneNumberNote');

// Divan Controller
Route::get('/add-divan'				,  'DivanController@addDivan');
Route::post('/add-divanDB'			,  'DivanController@storeDivan');
Route::get('/allDivans'				,  'DivanController@allDivans');
Route::get('/divan/{divan}/show'	,  'DivanController@showDivan');
Route::get('/divan/{divan}/delete'	,  'DivanController@deleteDivan');


// Offer Controller
Route::get('/add-offer'				,  'OfferController@addOffer');
Route::post('/addOfferDB'			,  'OfferController@storeOffer');
Route::get('/allOffers'				,  'OfferController@allOffers');
Route::get('/delete-offer/{id}'	    ,  'OfferController@deleteOffer');
Route::get('/change-offer/{id}'	    ,  'OfferController@changeState');




// include file category routes 
require_once "category_routes.php";

// include file menu routes 
require_once "menu_routes.php";

// include file item routes 
require_once "item_routes.php";

// include file users routes
require_once "user_routes.php";

// include file home routes
require_once "home_routes.php";

// include file tag routes
require_once "tag_routes.php";

Route::get('/{else}',function(){
	echo "OOPs || Sorry the page is not found";
});

