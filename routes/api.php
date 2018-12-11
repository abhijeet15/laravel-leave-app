<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group([ 'prefix' => 'user', 'middleware' => 'auth.api' ], function(){
// 	Route::get('/list', function( Request $request ){
// 		 $cust = App\User::orderBy('id', 'desc')->paginate( config( "app.record_per_page" ) );

//         return response( )->json( $cust->toArray( ) );
// 	});
// 	/*Route::get('/{subscription}', 'SubscriptionController@show');
// 	Route::post('/', 'SubscriptionController@store');
// 	Route::delete('/{subscription}', 'SubscriptionController@delete');
// 	Route::patch('/{subscription}', 'SubscriptionController@update');*/
// });

