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

/**
 * Exclude IP's for Google Analytics
 */
//$app->get('/google/analytics/exclude_ip', '\Api\Plugin\Google\Analytics\ExcludeIP');