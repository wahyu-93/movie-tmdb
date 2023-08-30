{{-- banner --}}
<div class="w-full h-[512px] bg-black relative flex flex-col">
    {{-- banner data --}}

    @foreach ($bannerArray as $banner)    
        <div class="flex flex-row items-center w-full h-full relative slide">
            <img src="{{ $imageBaseURL . '/original' . $banner->backdrop_path }}" class="w-full h-full absolute object-cover">
            <div class="w-full h-full bg-black bg-opacity-40 absolute"></div>

            <div class="w-10/12 flex flex-col ml-28 z-10">
                <span class="text-4xl font-bold text-white font-inter">
                    {{ $banner->title }}
                </span>

                <span class="font-inter text-xl text-white w-1/2 line-clamp-2">{{ $banner->overview }}</span>
                
                <a href="" class="w-fit text-white bg-blue-300 mt-5 pl-2 pr-4 py-2 font-inter text-sm flex flex-row items-center rounded-full hover:drop-shadow-lg duration-200">
                    <svg fill="#000000" height="16" width="16" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 210 210" xml:space="preserve">
                        <path d="M179.07,105L30.93,210V0L179.07,105z" class="fill-white"/>
                    </svg>
                
                    <span class="font-inter mx-1">Detail</span>
                </a>
            </div>
        </div>
    @endforeach
    {{-- prev button --}}
    <div class="absolute left-0 w-1/12 flex justify-center top-1/2 -translate-y-1/2 ">
        <button class="bg-white p-3 rounded-full opacity-20 hover:opacity-100 duration-200" onclick="moveSlide(-1)">
            <svg fill="#000000" height="16" width="16" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve">
                <path id="XMLID_92_" d="M111.213,165.004L250.607,25.607c5.858-5.858,5.858-15.355,0-21.213c-5.858-5.858-15.355-5.858-21.213,0.001
                    l-150,150.004C76.58,157.211,75,161.026,75,165.004c0,3.979,1.581,7.794,4.394,10.607l150,149.996
                    C232.322,328.536,236.161,330,240,330s7.678-1.464,10.607-4.394c5.858-5.858,5.858-15.355,0-21.213L111.213,165.004z"/>
            </svg>
        </button>
    </div>

    {{-- next button --}}
    <div class="absolute right-0 w-1/12 flex justify-center top-1/2 -translate-y-1/2">
        <button class="bg-white p-3 rounded-full opacity-20 hover:opacity-100 duration-200 rotate-180" onclick="moveSlide(1)">
            <svg fill="#000000" height="16" width="16" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 330 330" xml:space="preserve">
                <path id="XMLID_92_" d="M111.213,165.004L250.607,25.607c5.858-5.858,5.858-15.355,0-21.213c-5.858-5.858-15.355-5.858-21.213,0.001
                    l-150,150.004C76.58,157.211,75,161.026,75,165.004c0,3.979,1.581,7.794,4.394,10.607l150,149.996
                    C232.322,328.536,236.161,330,240,330s7.678-1.464,10.607-4.394c5.858-5.858,5.858-15.355,0-21.213L111.213,165.004z"/>
            </svg>
        </button>
    </div>

    {{-- indikator --}}
    <div class="absolute w-full bottom-0 mb-8">
        <div class="w-full flex flex-row items-center justify-center">
           
            @for($pos = 1; $pos <= count($bannerArray); $pos++)
                <div class="w-2.5 h-2.5 rounded-full bg-white mx-1 cursor-pointer dot" onclick="currentSlide({{ $pos }})"></div>
            @endfor
        </div>
    </div>
</div>

@push('script')
    <script>
        // akif banner
        let slideIndex = 1
        showSlide(slideIndex);

        function showSlide(position)
        {
            let index;
            const slides = document.getElementsByClassName('slide')
            const dots = document.getElementsByClassName('dot')

            if(position > slides.length){
            slideIndex = 1;
            };

            if(position < 1 ){
                slideIndex = slides.length;
            }

            for (index=0; index < slides.length; index++){
                slides[index].classList.add('hidden');
                dots[index].classList.add('bg-white')
            }

            slides[slideIndex - 1].classList.remove('hidden');
            dots[slideIndex - 1].classList.remove('bg-white');
            dots[slideIndex - 1].classList.add('bg-blue-300')
        }

        function moveSlide(position)
        {
            showSlide(slideIndex += position)
        }

        function currentSlide(position)
        {
            slideIndex = position
            showSlide(slideIndex)
        }
        
    </script>
@endpush