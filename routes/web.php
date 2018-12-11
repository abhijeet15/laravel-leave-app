<?php

use App\User;
use App\Leave;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// -- User Module.
Route::group([ 'prefix' => 'user', 'middleware' => 'auth' ], function(){
	Route::get('/', 'UserController@index');
	Route::get('/list', function( Request $request ){
        return response( )->json( 
        	User::orderBy('id', 'desc')->paginate( config( "app.record_per_page" ) 
		) );
	});
	Route::patch('/changerole/{user}/{changerole_to}', 'UserController@changerole');
	Route::delete('/{user}', 'UserController@delete');
});

// -- Leave Module.
Route::group([ 'prefix' => 'leave', 'middleware' => 'auth' ], function(){
	Route::get('/', 'LeaveController@index');
	Route::get('/list', function( Request $request ){
        return response( )->json( 
        	Leave::orderBy('id', 'desc')->with([ 'user', 'backup_user' ])->paginate( config( "app.record_per_page" ) 
		) );
	});
	Route::post('/', 'LeaveController@store');
	Route::delete('/{user}', 'LeaveController@delete');
});
