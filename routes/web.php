<?php

use \App\Api;

/**
 * Main Route
 */
Route::get('/', function (Request $request)
{
	return view('api');
});

/**
 * Ping Test
 */
Route::get('/ping/{ip}', function ($ip)
{
	new Api\Plugin\Ping([
		'ip' => $ip,
	]);
});

Route::get('/check-pulse/{code}', function ($code)
{
	new Api\Plugin\CheckPulse([
		'code' => $code,
	]);
});

/**
 * Exclude IP's for Google Analytics
 */
Route::get('/google/analytics/exclude-ip', function ()
{
	new Api\Plugin\Google\Analytics\ExcludeIP();
});