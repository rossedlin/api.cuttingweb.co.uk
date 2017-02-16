<?php

use Illuminate\Http\Request;
use \App\Api;

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

Route::post('/email', function (Request $request)
{
	new Api\Plugin\Email($request);
});

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:api');
