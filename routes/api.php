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

Route::get('/check-pulse/{code}', function (Request $request, $code)
{
	new Api\Plugin\CheckPulse($request, [
		'code' => $code,
	]);
});

Route::post('/email', function (Request $request)
{
	new Api\Plugin\Email($request);
});

/**
 * Exclude IP's for Google Analytics
 */
Route::get('/google/analytics/exclude-ip', function (Request $request)
{
	new Api\Plugin\Google\Analytics\ExcludeIP($request);
});

/**
 * Ping Test
 */
Route::get('/my-ip', function (Request $request)
{
	new Api\Plugin\MyIp($request);
});

/**
 * Ping Test
 */
Route::get('/ping/{ip}', function (Request $request, $ip)
{
	new Api\Plugin\Ping($request, [
		'ip' => $ip,
	]);
});

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:api'); 