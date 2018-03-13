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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});



Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('home');

    // Editor routes
    Route::get('/editor', 'EditorController@index')->name('editor');

    // Postcard routes
    Route::post('postcard/store', 'PostcardController@store')->name('postcard.store');;
    Route::put('postcard/update/{postcard_id}', 'PostcardController@update')->name('postcard.update');;
    Route::post('postcard/tempfill', 'PostcardController@tempFill')->name('postcard.tempfill');;

    // User routes
    Route::get('profile', 'UserController@profile')->name('user.profile');
    Route::get('my-postcards', 'PostcardController@userPostcards')->name('user.postcards');

    // Companies routes
    Route::get('companies', 'CompanyController@index')->name('companies.index');
    Route::get('companies/{id}', 'CompanyController@show')->name('companies.show');

    Route::post('csv/import', 'AddressController@csvImport')->name('csv.import');
    Route::get('companies/{id}/postcards', 'CompanyController@postcards')->name('companies.postcards');
});



// API routes
Route::group(['prefix' => 'api', 'middleware' => 'auth'], function(){
    // Api editor usage routes
    Route::get('companies-from-editor', 'CompanyController@apiIndexFromEditor')->name('api.companies.index-from-editor');
    Route::post('companies/create-from-editor', 'CompanyController@apiCreateFromEditor')->name('api.companies.create-from-editor');
    Route::put('companies/update-from-editor/{id}', 'CompanyController@apiUpdateFromEditor')->name('api.companies.update-from-editor');

    // Api companies routes
    Route::get('companies', 'CompanyController@apiIndex')->name('api.companies.index');
    Route::post('companies/create', 'CompanyController@apiCreate')->name('api.companies.create');
    Route::get('companies/{id}', 'CompanyController@apiShow')->name('api.companies.show');
    Route::put('companies/{id}', 'CompanyController@apiUpdate')->name('api.companies.update');
    Route::delete('companies/{id}', 'CompanyController@apiDelete')->name('api.companies.delete');
    Route::get('companies/{id}/postcards', 'CompanyController@apiPostcards')->name('api.companies.postcards');

    // Api address routes
    Route::post('addresses/addresslists/{id}/insert', 'AddressController@apiAddressListsInsert')->name('api.address.addresslists.insert');
    Route::put('address/{id}', 'AddressController@apiUpdate')->name('api.address.update');
    Route::delete('address/{id}', 'AddressController@apiDelete')->name('api.address.delete');
    Route::put('address/{id}/setnulladdresslist', 'AddressController@apiSetNullAddressList')->name('api.address.setnulladdresslist');

    // Api address lists routes
    Route::post('addresslists/create', 'AddressListController@apiCreate')->name('api.addresslists.create');
    Route::put('addresslists/{id}', 'AddressListController@apiUpdate')->name('api.addresslists.update');
    Route::delete('addresslists/{id}', 'AddressListController@apiDelete')->name('api.addresslists.delete');
});
