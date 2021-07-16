<x-app-layout>
    <style>
        .test {
            display: flex;
            min-height: 100px;
            position: relative;
        }

        .test > img{
            flex-shrink: 0;
            display: inline-block;
            width: calc((100% - (4 * 2%)) / 4.5 );
            margin-right: 2%;
            object-fit: cover
        }

        .test > img:last-child {
            margin-right: 0;
        }

        @media (max-width: 976px) {
            .test > img{
                width: calc((100% - (3 * 2%)) / 3.5 );
            } 
        }
        @media (max-width: 676px) {
            .test > img{
                width: calc((100% - (2 * 2%)) / 2.5 );
            } 
        }
        
        @media (max-width: 420px) {
            
            .test > img{
                width: calc((100% - (2 * 2%)) / 1.5 );
            } 
        }

    </style>
    
    <h1 class="text-2xl font-bold border-b-4 border-indigo-700 mb-12"> Accueil</h1>
    <div class="flex items-center space-x-4">
        <h2 class="text-xl font-bold tracking-wider">Nouveautés</h2>
        <hr class="border-gray-800 border-t-4 w-full"></hr>
    </div>
    <div class="overflow-hidden relative">
        <button class="h-full w-10 bg-black absolute flex items-center justify-center bg-opacity-20 top-0 left-0 z-10">
            <i class="fa fa-arrow-left absolute top-1/2 transform -translate-y-1/2 text-white"></i>
        </button>
        <div class="test">
            <img src="{{ $animes->first()->image }}"></img>
            <img src="{{ $animes[2]->image }}"></img>
            <img src="{{ $animes->first()->image }}"></img>
            <img src="{{ $animes->first()->image }}"></img>
            <img src="{{ $animes->first()->image }}"></img>
            <img src="{{ $animes->first()->image }}"></img>
            <img src="{{ $animes->first()->image }}"></img>
        </div>
        {{-- <img class="w-1/4 flex-shrink-0 h-32" style="transform: scale(110%)" src="{{ $animes->first()->image }}"></img> --}}
        <button class="h-full w-10 bg-black absolute flex items-center justify-center bg-opacity-20 top-0 right-0 z-10">
            <i class="fa fa-arrow-right absolute top-1/2 transform -translate-y-1/2 text-white"></i>
        </button>
    </div>
    <script>
        const leftButton = document.querySelector('.fa-arrow-left');
        const rightButton = document.querySelector('.fa-arrow-right');
        rightButton.addEventListener('click', rightClick);
        const test = document.querySelector('.test');
        const visible = 4;
        const lastPos = visible - document.querySelectorAll('.test > img').length - 1;
        const beforeLastPos = lastPos - 1;
        let currentPos = 0;
        

        function rightClick() {
            test.style.transform = 'translateX(calc((100% - (4 * 2%)) / 4.5 ))'
        }
    </script>
</x-app-layout>