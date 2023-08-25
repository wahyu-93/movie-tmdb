<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function index()
    {
        $baseURL = config('services.tmdb.TMDB_BASE_URL');
        $imageBaseURL = config('service.tmdb.TMDB_IMAGE_BASE_URL');
        $apiKey = config('services.tmdb.TMDB_API_KEY');
        
        $url = $baseURL . '/trending/movie/week';
        $bannerResponse = Http::get($url, [
            'api_key' => $apiKey
        ]);

        $bannerArray = [];

        if($bannerResponse->successful()){
            $resultArray = $bannerResponse->object()->results;
            if($resultArray){
                foreach($resultArray as $item){
                    array_push($bannerArray, $item);

                    if (count($bannerArray) >= 3){
                        break;
                    };
                };
            };
        };
        
        return view('home',compact('bannerArray'));
    }
}
