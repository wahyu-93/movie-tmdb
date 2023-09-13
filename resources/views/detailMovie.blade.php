<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BeeCinemation | Detail - {{ $detailMovie->title }}</title>
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="w-full h-screen flex flex-col relative">
        <img src="{{ $imageBaseURL }}/original{{ $detailMovie->backdrop_path }}" alt="" class="w-full h-screen object-cover lg:object-fill absolute">
        <div class="absolute w-full h-screen bg-black z-10 bg-opacity-40"></div>
        
        {{-- header --}}
        <div class="w-full bg-transparant drop-shadow-lg h-[96px] flex flex-row items-center z-10">
            <div class="w-1/3 flex pl-5 text-5xl font-bold text-white hover:text-blue-300 duration-200 cursor-pointer font-caveat">
                <a href="{{ route('home') }}">BeeCinemation</a>
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
        
        <div class="w-full h-full z-10 flex flex-col justify-center px-20">
            <span class="text-white text-6xl font-quicksand font-bold">{{ $detailMovie->title }}</span>
            <span class="text-white font-quicksand text-2xl italic max-w-3xl line-clamp-5 mt-4">{{ $detailMovie->tagline ?? $detailMovie->overview }}</span>

            <div class="flex flex-row items-center mt-4">
                @php
                    // circumference = 2 × π × radius(lihat circle r=32)
                    $circumference = 2*3.14*32;    
                    // offset = circumference × ((100 - progress)/100) (progres dari vote_average*10)
                    $offset = $circumference * ((100 - round($detailMovie->vote_average * 10))/100);

                    $trailerId = '';
                    if($detailMovie->videos->results){
                        foreach($detailMovie->videos->results as $item){
                            if($item->type == "Trailer"){
                                $trailerId = $item->key;
                                break;
                            }
                        }
                    }
                @endphp

                <div class="w-20 h-20 bg-red-100 rounded-full flex justify-center items-center mr-4" style="background: #00304D;">
                    <svg class="-rotate-90 w-20 h-20">
                        <circle 
                            style="color: #004F80;"
                            stroke-width="8"
                            stroke="currentColor"
                            fill="transparent"
                            r="32"
                            cx="40"
                            cy="40"
                            />
                            <circle 
                            style="color: #6FCF97;"
                            stroke-width="8"
                            stroke-dasharray="{{ $circumference }}"
                            stroke-dashoffset="{{ $offset }}"
                            stroke-linecap="round"
                            stroke="currentColor"
                            fill="transparent"
                            r="32"
                            cx="40"
                            cy="40"
                            />
                        </svg>
                        <span class="text-white absolute font-inter font-bold text-xl">{{ round($detailMovie->vote_average * 10) }}% </span>
                    </div>

                <div class="p-4 border border-white rounded-lg">
                    <span class="text-white text-2xl font-inter">{{ date_format(new DateTime($detailMovie->release_date), "Y") }}</span>
                </div>

                @if($detailMovie->runtime)
                    <div class="mx-2 p-4 border border-white rounded-lg">
                        <span class="text-white text-2xl font-inter">{{ (int)($detailMovie->runtime/60).'h '.($detailMovie->runtime % 60).'m' }}</span>
                    </div>
                @endif
            </div>

            @if($trailerId)
                <div class="mt-4 relative">
                    <div class="absolute left-0 inset-y-0 flex justify-center items-center pl-6 pointer-events-none">
                        <svg fill="#000000" height="18" width="18" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 210 210" xml:space="preserve">
                            <path d="M179.07,105L30.93,210V0L179.07,105z" class="fill-white"/>
                        </svg>
                    </div>

                    <button class="bg-blue-400 py-4 px-10 rounded-xl pr-6" onclick="showTrailer(true)">
                        <span class="text-white text-2xl mt-4 font-inter ml-2">Play Trailer</span>
                    </button>
                </div>
            @endif

        </div>

        {{-- trailer section --}}
        <div class="w-full h-screen z-10 bg-black p-20 flex flex-col absolute" id="thrillerWrapper">
            <button class="ml-auto mb-4" onclick="showTrailer(false)">
                <svg fill="#000000" height="24" width="24" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 460.775 460.775" xml:space="preserve">
                    <path d="M285.08,230.397L456.218,59.27c6.076-6.077,6.076-15.911,0-21.986L423.511,4.565c-2.913-2.911-6.866-4.55-10.992-4.55
                        c-4.127,0-8.08,1.639-10.993,4.55l-171.138,171.14L59.25,4.565c-2.913-2.911-6.866-4.55-10.993-4.55
                        c-4.126,0-8.08,1.639-10.992,4.55L4.558,37.284c-6.077,6.075-6.077,15.909,0,21.986l171.138,171.128L4.575,401.505
                        c-6.074,6.077-6.074,15.911,0,21.986l32.709,32.719c2.911,2.911,6.865,4.55,10.992,4.55c4.127,0,8.08-1.639,10.994-4.55
                        l171.117-171.12l171.118,171.12c2.913,2.911,6.866,4.55,10.993,4.55c4.128,0,8.081-1.639,10.992-4.55l32.709-32.719
                        c6.074-6.075,6.074-15.909,0-21.986L285.08,230.397z" class="fill-white"/>
                </svg>
            </button>

            <iframe 
                id="youtubeVideo"
                class="h-full w-full" 
                src="https://www.youtube.com/embed/{{ $trailerId }}?enablejsapi=1" 
                title="{{ $detailMovie->title }}" f
                rameborder="0" 
                allow="accelerometer; autoplay; clipbord-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                allowfullscreen>
            </iframe>
        </div>
    </div>

    <script>
        const thrillerWrapper = document.getElementById('thrillerWrapper')
        const youtubeVideo = document.getElementById('youtubeVideo')

        thrillerWrapper.style.visibility = 'hidden'

        function showTrailer(isVisible)
        {
            if(isVisible){
                thrillerWrapper.style.visibility = 'visible'
            }
            else {
                youtubeVideo.contentWindow.postMessage('{"event" : "command", "func":"' + 'stopVideo' + '","args":""}', '*')
                console.log(youtubeVideo.contentWindow.postMessage)
                thrillerWrapper.style.visibility = 'hidden'
            }
        }

        
    </script>
</body>
</html>