<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/itunes', function (Request $request) {
    $term = urlencode('Stick Figure');
    $cacheKey = "itunes-api-$term";
    $seconds = 60 * 5;

    $response = Cache::remember($cacheKey, $seconds, function () use ($term) {
        return Http::get("https://itunes.apple.com/search?term=$term")->object();
    });

    //  dd($response);

    return view('api.itunes', [
        'response' => $response,
    ]);
 });