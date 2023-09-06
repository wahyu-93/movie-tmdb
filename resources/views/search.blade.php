@extends('base')

@section('content')
    <div class="w-full h-auto min-h-screen">
        {{-- search --}}
        <div class="w-full pl-10 mt-10">
            <div class="relative w-full lg:w-80 bg-white drop-shadow-[0_0px_4px_rgba(0,0,0,0.25)] rounded-l-xl">
                <div class="absolute inset-y-0 left-0 flex items-center mx-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" class="fill-black group-hover:fill-blue-300" />
                    </svg>
                </div>
                <input type="text" placeholder="Search ..." id="search" class="block w-full p-4 mx-4 text-black rounded-r-xl focus:outline-none">
            </div>
        </div>

        {{-- content --}}
        <div class="w-auto pl-10 mt-5 pb-10 grid grid-cols-3 md:grid-cols-5 gap-5" id="dataWrapper">
          
        </div>

        {{-- autoload --}}
        <div id="autoLoad" class="mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; display: block; shape-rendering: auto;" width="50px" height="50px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                <path d="M10 50A40 40 0 0 0 90 50A40 42 0 0 1 10 50" fill="#93dbe9" stroke="none">
                  <animateTransform attributeName="transform" type="rotate" dur="1s" repeatCount="indefinite" keyTimes="0;1" values="0 50 51;360 50 51"></animateTransform>
                </path>
            </svg>
        </div>

          {{-- notifikasi --}}
          <div class="bg-red-700 fixed z-10 top-0 mt-4 right-0 mr-[75px] w-[400px] p-4 rounded-lg" id="notif">
            <span class="font-inter font-xl text-white text-center" id="notifMessage">Http Error 404</span>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const autoLoad = document.getElementById('autoLoad')
        const notifikasi = document.getElementById('notif')
        const dataWrapper = document.getElementById('dataWrapper')
        const notifMessage = document.getElementById('notifMessage')
        const apiKey = "{{ $apiKey }}"
        let search = document.getElementById('search')

        autoLoad.style.display = 'none'
        notifikasi.style.display = 'none'

        search.addEventListener("keypress", function(e){
            if(e.keyCode == 13){
                autoLoad.style.display = 'block'
                loadMore()
            }
        })

        async function loadMore()
        {
            autoLoad.style.display = 'block'
            dataWrapper.innerHTML = ""

            url = `{{ $baseURL }}/search/multi?query=${search.value}&page=1&api_key=${apiKey}`
            const response = await fetch(url)
            const data = await response.json()
           console.log(data)
            if(!response.ok){
                notifikasi.style.display = 'block'
                setTimeout(() => {
                    notifikasi.style.display = 'none'
                }, 3000);
            }

            if(data.results.length == 0){
                notifikasi.style.display = 'block'
                notifMessage.innerHTML = "List Movie/Tv Show Not Found"
                setTimeout(() => {
                    notifikasi.style.display = 'none'
                }, 3000);
            }
        
            // get data success
            htmlData = [];
            data.results.forEach(item => {
                let tanggal = new Date(item.release_date)
                htmlData.push(`<a href="tv/${item.id}" class="group">
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
            }, 1000);
        }

    </script>
@endpush()