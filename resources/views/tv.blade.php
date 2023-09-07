@extends('base')

@section('title', 'BeeCinemation | Tv Show')

@section('content')
    {{-- sort content --}}
    <div class="py-5 flex flex-row items-center">
        <span class="font-bold font-inter text-xl ml-28 mr-4">Sort</span>
        <div class="flex relative items-center">
            <select name="sort" id="sort" class="appearance-none bg-white drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] p-3 rounded-lg focus:outline-none pr-8" onchange="sort(this)">
                <option value="popularity.desc">Popularity (Descending)</option>
                <option value="popularity.asc">Popularity (Ascending)</option>
                <option value="vote_average.desc">Top Rated (Descending)</option>
                <option value="vote_average.asc">Top Rated (Ascending)</option>
            </select>

            <div class="absolute right-0 mx-4 pointer-events-none">
                <svg fill="#000000" height="10" width="10" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve">
                    <path id="XMLID_225_" d="M325.607,79.393c-5.857-5.857-15.355-5.858-21.213,0.001l-139.39,139.393L25.607,79.393 c-5.857-5.857-15.355-5.858-21.213,0.001c-5.858,5.858-5.858,15.355,0,21.213l150.004,150c2.813,2.813,6.628,4.393,10.606,4.393 s7.794-1.581,10.606-4.394l149.996-150C331.465,94.749,331.465,85.251,325.607,79.393z"/>
                </svg>
            </div>
        </div>
    </div>

    {{-- movie content --}}
    <div class="pl-28 pr-10 relative">
        <div class="grid grid-cols-3 md:grid-cols-5 gap-5 pb-5" id="dataWrapper">
            @foreach ($tvs as $tv)
                <a href="{{ route('detail.tv', [$tv->id]) }}" class="group">
                    <div class="min-w-[232px] min-h-[428px] bg-white drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] group-hover:drop-shadow-[0_0px_8px_rgba(0,0,0,0.5)] rounded-[32px] p-5 flex flex-col mr-8 duration-100">
                        <div class="overflow-hidden rounded-[32px]">
                            <img src="{{ $imageBaseURL .'/w500'.$tv->poster_path }}" class="w-full h-[300px] group-hover:scale-125 duration-200">
                        </div>
        
                        <span class="mt-4 line-clamp-1 group-hover:line-clamp-none font-inter font-xl">{{ $tv->name }}</span>
                        <span class="font-inter font-sm">{{ date_format(new DateTime($tv->first_air_date), 'Y') }}</span>
        
                        <div class="flex flex-row mt-1 items-center">
                            <span>
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 16 16">
                                    <path class="fill-blue-300" fill="#444444" d="M16 7.1c0-1.5-1.4-2.1-2.2-2.1h-2.2c0.4-1 0.7-2.2 0.5-3.1-0.5-1.8-2-1.9-2.5-1.9h-0.1c-0.4 0-0.6 0.2-0.8 0.5l-1 2.8-2.7 2.7h-5v9h5v-1c0.2 0 0.7 0.3 1.2 0.6 1.2 0.6 2.9 1.5 4.5 1.5 2.4 0 3.2-0.3 3.8-1.3 0.3-0.6 0.3-1.1 0.3-1.4 0.2-0.2 0.5-0.5 0.6-1s0.1-0.8 0-1.1c0.2-0.3 0.4-0.7 0.5-1.3 0-0.5-0.1-0.9-0.2-1.2 0.1-0.4 0.3-0.9 0.3-1.7zM2.5 13.5c-0.6 0-1-0.4-1-1s0.4-1 1-1 1 0.4 1 1c0 0.6-0.4 1-1 1zM14.7 9.1c0 0 0.2 0.2 0.2 0.7 0 0.6-0.4 0.9-0.4 0.9l-0.3 0.3 0.2 0.3c0 0 0.2 0.3 0 0.7-0.1 0.4-0.5 0.7-0.5 0.7l-0.3 0.3 0.2 0.4c0 0 0.2 0.4-0.1 0.9-0.2 0.4-0.4 0.7-2.9 0.7-1.4 0-3-0.8-4.1-1.4-0.8-0.4-1.3-0.6-1.7-0.6v0-6h0.1c0.2 0 0.4-0.1 0.6-0.2l2.8-2.8c0.1-0.1 0.1-0.2 0.2-0.3l1-2.7c0.5 0 1.2 0.2 1.4 1.1 0.1 0.6-0.1 1.6-0.6 2.8-0.1 0.3-0.1 0.5 0.1 0.8 0.1 0.2 0.4 0.3 0.7 0.3h2.5c0.1 0 1.2 0.2 1.2 1.1 0 0.8-0.3 1.2-0.3 1.2l-0.3 0.4 0.3 0.4z"></path>
                                </svg>
                            </span>
        
                            <span class="font-inter text-sm ml-1">{{ $tv->vote_average * 10 }}%</span>
                        </div>
                    </div>
                </a>
            @endforeach
            
        </div>
        
        {{-- autoload --}}
        <div id="autoLoad" class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; display: block; shape-rendering: auto;" width="50px" height="50px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                <path d="M10 50A40 40 0 0 0 90 50A40 42 0 0 1 10 50" fill="#93dbe9" stroke="none">
                  <animateTransform attributeName="transform" type="rotate" dur="1s" repeatCount="indefinite" keyTimes="0;1" values="0 50 51;360 50 51"></animateTransform>
                </path>
            </svg>
        </div>


        {{-- loada more --}}
        <div class="w-full pr-8" id="loadMore">
            <button class="w-full bg-blue-400 text-white p-4 text-xl rounded-xl mb-5 text-center hover:bg-blue-300" onclick="loadMore()">Load More</button>
        </div>

        {{-- notifikasi --}}
        <div class="bg-red-700 fixed z-10 top-0 mt-4 right-0 mr-[75px] w-[400px] p-4 rounded-lg" id="notif">
            <span class="font-inter font-xl text-white text-center" id="notifMessage">Http Error 404</span>
        </div>
    </div>

    @push('script')
        <script>
            const autoLoad = document.getElementById('autoLoad')
            const notifikasi = document.getElementById('notif')
            const loadMoreDiv = document.getElementById('loadMore')

            let dataWrapper = document.getElementById('dataWrapper')
            let sort_by = 'popularity.desc'
            let page = 1
            let vote_count_gte = 100
            const apiKey = "{{ $apiKey }}"

            autoLoad.style.display = 'none'
            notifikasi.style.display = 'none'
       
            async function loadMore()
            {
                autoLoad.style.display = 'block'

                $url = `{{ $baseURL }}/discover/tv?sort_by=${sort_by}&page=${++page}&vote_count.gte=${vote_count_gte}&api_key=${apiKey}`
                const response = await fetch($url)
                const data = await response.json()
                
                if(!response.ok){
                    notifikasi.style.display = 'block'
                    setTimeout(() => {
                        notifikasi.style.display = 'none'
                    }, 3000);
                }

                // get data success
                htmlData = [];
                data.results.forEach(item => {
                    let tanggal = new Date(item.first_air_date)
                    
                    htmlData.push(`<a href="movie/${item.id}" class="group">
                    <div class="min-w-[232px] min-h-[428px] bg-white drop-shadow-[0_0px_8px_rgba(0,0,0,0.25)] group-hover:drop-shadow-[0_0px_8px_rgba(0,0,0,0.5)] rounded-[32px] p-5 flex flex-col mr-8 duration-100">
                        <div class="overflow-hidden rounded-[32px]">
                            <img src="{{ $imageBaseURL }}/w500${item.poster_path}" class="w-full h-[300px] group-hover:scale-125 duration-200">
                        </div>
        
                        <span class="mt-4 line-clamp-1 group-hover:line-clamp-none font-inter font-xl">${item.title}</span>
                        <span class="font-inter font-sm">${tanggal.getFullYear()}</span>
        
                        <div class="flex flex-row mt-1 items-center">
                            <span>
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 16 16">
                                    <path class="fill-blue-300" fill="#444444" d="M16 7.1c0-1.5-1.4-2.1-2.2-2.1h-2.2c0.4-1 0.7-2.2 0.5-3.1-0.5-1.8-2-1.9-2.5-1.9h-0.1c-0.4 0-0.6 0.2-0.8 0.5l-1 2.8-2.7 2.7h-5v9h5v-1c0.2 0 0.7 0.3 1.2 0.6 1.2 0.6 2.9 1.5 4.5 1.5 2.4 0 3.2-0.3 3.8-1.3 0.3-0.6 0.3-1.1 0.3-1.4 0.2-0.2 0.5-0.5 0.6-1s0.1-0.8 0-1.1c0.2-0.3 0.4-0.7 0.5-1.3 0-0.5-0.1-0.9-0.2-1.2 0.1-0.4 0.3-0.9 0.3-1.7zM2.5 13.5c-0.6 0-1-0.4-1-1s0.4-1 1-1 1 0.4 1 1c0 0.6-0.4 1-1 1zM14.7 9.1c0 0 0.2 0.2 0.2 0.7 0 0.6-0.4 0.9-0.4 0.9l-0.3 0.3 0.2 0.3c0 0 0.2 0.3 0 0.7-0.1 0.4-0.5 0.7-0.5 0.7l-0.3 0.3 0.2 0.4c0 0 0.2 0.4-0.1 0.9-0.2 0.4-0.4 0.7-2.9 0.7-1.4 0-3-0.8-4.1-1.4-0.8-0.4-1.3-0.6-1.7-0.6v0-6h0.1c0.2 0 0.4-0.1 0.6-0.2l2.8-2.8c0.1-0.1 0.1-0.2 0.2-0.3l1-2.7c0.5 0 1.2 0.2 1.4 1.1 0.1 0.6-0.1 1.6-0.6 2.8-0.1 0.3-0.1 0.5 0.1 0.8 0.1 0.2 0.4 0.3 0.7 0.3h2.5c0.1 0 1.2 0.2 1.2 1.1 0 0.8-0.3 1.2-0.3 1.2l-0.3 0.4 0.3 0.4z"></path>
                                </svg>
                            </span>
        
                            <span class="font-inter text-sm ml-1">${item.vote_average * 10}%</span>
                        </div>
                    </div>
                </a>`)
                })

                setTimeout(() => {
                    autoLoad.style.display = 'none'
                    dataWrapper.innerHTML += htmlData.join("")
                }, 500);
            }

            function sort(component)
            {
                sort_by = component

                dataWrapper.innerHTML = ""
                autoLoad.style.display = 'block'
                // loadMoreDiv.style.display = 'none'

                setTimeout(() => {
                    autoLoad.style.display = 'none'
                    loadMore()
                }, 1000);
            }
        </script>
    @endpush

@endsection