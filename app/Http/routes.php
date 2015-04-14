<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Archivo;
use App\User;

Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');
Route::get('upload', 'HomeController@upload_get');
Route::post('upload', 'HomeController@upload_post');
Route::get('download/{id}', 'HomeController@download');
Route::get('misArchivos', 'HomeController@myfiles');
Route::get('success', 'HomeController@success');
Route::get('share/{id}', 'HomeController@share');
Route::post('sharewith', 'HomeController@sharewith');

Route::get('create', 'HomeController@create_get');
Route::post('/admin/register', 'HomeController@create_post');


Route::get('usuario', function(){
	return Auth::user()->id;
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


