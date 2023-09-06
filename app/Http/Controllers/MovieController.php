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

    public function movies()
    {
        $baseURL = config('services.tmdb.TMDB_BASE_URL');
        $imageBaseURL = config('services.tmdb.TMDB_IMAGE_BASE_URL');
        $apiKey = config('services.tmdb.TMDB_API_KEY');
        
        $url = $baseURL . '/discover/movie/';
        $movieResponse = Http::get($url, [
            'api_key' => $apiKey,
            'page'  => 1,
            'sort_by'=> 'popularity.desc',
            'vote_count.gte' => 100
        ]);

        $movies = [];

        if($movieResponse->successful()){
            $movieArray = $movieResponse->object()->results;            
            foreach($movieArray as $item){
                array_push($movies,$item);
            };
        };
   
        return view('movies', compact('movies', 'imageBaseURL', 'baseURL', 'apiKey'));
    }

    public function tvShow()
    {
        $baseURL = config('services.tmdb.TMDB_BASE_URL');
        $imageBaseURL = config('services.tmdb.TMDB_IMAGE_BASE_URL');
        $apiKey = config('services.tmdb.TMDB_API_KEY');
        
        $url = $baseURL . '/discover/tv/';
        $tvResponse = Http::get($url, [
            'api_key' => $apiKey,
            'page'  => 1,
            'sort_by'=> 'popularity.desc',
            'vote_count.gte' => 100
        ]);

        $tvs = [];

        if($tvResponse->successful()){
            $tvArray = $tvResponse->object()->results;            
            foreach($tvArray as $item){
                array_push($tvs,$item);
            };
        };
   
        return view('tv', compact('tvs', 'imageBaseURL', 'baseURL', 'apiKey'));       
    }

    public function search()
    {
        $baseURL = config('services.tmdb.TMDB_BASE_URL');
        $imageBaseURL = config('services.tmdb.TMDB_IMAGE_BASE_URL');
        $apiKey = config('services.tmdb.TMDB_API_KEY');
        
        return view('search', compact('baseURL', 'imageBaseURL', 'apiKey'));
    }
}
