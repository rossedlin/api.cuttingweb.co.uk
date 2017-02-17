<?php

/**
 * Main Route
 */
Route::get('/', function (Request $request)
{
	return view('api');
});