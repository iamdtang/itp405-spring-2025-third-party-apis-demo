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

Route::get('/yelp', function () {
    // Using the Business Search API: https://docs.developer.yelp.com/reference/v3_business_search
    $queryString = http_build_query([
        'term' => 'vegan',
        'location' => 'Los Angeles',
    ]);

    // We can set headers for our request using withHeaders()
    // https://laravel.com/docs/12.x/http-client#headers
    // Sending our API key in our request under the `Authorization` header.
    // return Http::withHeaders([
    //     'Authorization' => "Bearer " . env('YELP_API_KEY')
    // ])
    //     ->get("https://api.yelp.com/v3/businesses/search?$queryString")
    //     ->json();
    
    $cacheKey = "yelp-api-$queryString";
    $seconds = 60;

    $response = Cache::remember($cacheKey, $seconds, function () use ($queryString) {
        // OR you can use withToken to set the Authorization header
        // https://laravel.com/docs/12.x/http-client#bearer-tokens
        return Http::withToken(env('YELP_API_KEY'))
            ->get("https://api.yelp.com/v3/businesses/search?$queryString")
            ->object();
    });

    dd($response);
});