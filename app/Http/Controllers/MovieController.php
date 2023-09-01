<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function index()
    {
        $baseURL = config('services.tmdb.TMDB_BASE_URL');
        $imageBaseURL = config('services.tmdb.TMDB_IMAGE_BASE_URL');
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

        $url = $baseURL . '/movie/top_rated';
        $topResponse = Http::get($url, [
            'api_key' => $apiKey
        ]);

        $topMovies = [];
        if($topResponse->successful()){
            $resultArray = $topResponse->object()->results;
            if($resultArray){
                foreach($resultArray as $item){
                    array_push($topMovies, $item);

                    if (count($topMovies) >= 10){
                        break;
                    };
                };
            };
        };

        $url = $baseURL . '/tv/top_rated';
        $topResponseTv = Http::get($url, [
            'api_key' => $apiKey
        ]);

        $topTv = [];

        if($topResponseTv->successful()){
           $topTvArray = $topResponseTv->object()->results;
           if($topTvArray){
               foreach($topTvArray as $item){
                   array_push($topTv, $item);
                   if(count($topTv) >= 10){
                       break;
                   };
               };
           };
        };

        return view('home',compact('bannerArray', 'imageBaseURL', 'topMovies', 'topTv'));
    }
}
