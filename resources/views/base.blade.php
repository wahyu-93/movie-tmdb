<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Bee-Cinema|Watch Movie</title>
</head>
<body>
    <div class="w-full h-auto min-h-screen flex flex-col">
        @include('page/header')
    </div>
    
    @yield('content')

    <script>
        // akif banner
        let slideIndex = 4
        showSlide(slideIndex);

        function showSlide(position)
        {
            let index;
            const slides = document.getElementsByClassName('slide')

            if(position > slides.length){
                slideIndex = 1;
            };

            if(position < slides.length){
                slideIndex = slides.length;
            }

            console.log(position)

            for (index=0; index <= slides.length; index++){
                slides[index].classList.addList('hidden');
            }


        }


        
    </script>
    
</body>
</html>