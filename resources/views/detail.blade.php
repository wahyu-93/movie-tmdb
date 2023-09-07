<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>BeeCinemation | Detail - {{ $movieDetail->original_title }}</title>
</head>
<body>
    <div class="w-full h-screen flex flex-col relative">
        @php
            $gambar = $movieDetail ? $imageBaseURL.'/original'.$movieDetail->backdrop_path : '';
        @endphp
        <img src="{{ $gambar }}" alt="" class="w-full h-screen object-cover lg:object-fill">
        <div class="absolute w-full h-screen bg-black z-10 bg-opacity-60"></div>

        {{-- header content --}}
        <div class="w-full bg-transparan drop-shadow-lg h-[96px] flex flex-row items-center z-10 absolute">
            <div class="w-1/3 flex pl-5 text-5xl font-bold hover:text-blue-300 duration-200 cursor-pointer font-caveat">
                <a href="{{ route('home') }}" class="text-white">BeeCinemation</a>
            </div>
            <div class="w-1/3 text-center">
                <a href="{{ route('movies') }}" class="uppercase text-base text-white hover:text-blue-300 duration-200 font-inter mx-5">Movie</a>
                <a href="{{ route('tv') }}" class="uppercase text-base text-white hover:text-blue-300 duration-200 font-inter">Tv Show</a>
            </div>
            <div class="w-1/3 flex justify-end pr-10">
                <a href="{{ route('search') }}" class="group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" class="fill-white group-hover:fill-blue-300" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</body>
</html>