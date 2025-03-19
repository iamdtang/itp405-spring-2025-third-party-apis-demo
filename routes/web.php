<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/itunes', function (Request $request) {
    $term = urlencode('Stick Figure');
    $response = Http::get("https://itunes.apple.com/search?term=$term")->object();

    //  dd($response);

    return view('api.itunes', [
        'response' => $response,
    ]);
 });