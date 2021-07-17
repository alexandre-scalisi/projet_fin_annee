<x-app-layout>
    
    <h1 class="text-2xl font-bold border-b-4 border-indigo-700 mb-12"> Accueil</h1>
    <div class="flex items-center space-x-4">
        <h2 class="text-xl font-bold tracking-wider">Nouveautés</h2>
        <hr class="border-gray-800 border-t-4 w-full"></hr>
    </div>
    <div class="overflow-hidden relative">
        <button id="left-btn"class="h-full w-10 bg-black absolute flex items-center justify-center bg-opacity-20 top-0 left-0 z-10 hidden">
            <i class="fa fa-arrow-left absolute top-1/2 transform -translate-y-1/2 text-white"></i>
        </button>
        <div class="slider">
            <img src="{{ $animes->first()->image }}"></img>
            <img src="{{ $animes->first()->image }}"></img>
            <img src="{{ $animes->first()->image }}"></img>
            <img src="{{ $animes->first()->image }}"></img>
            <img src="{{ $animes->first()->image }}"></img>
            <img src="{{ $animes->first()->image }}"></img>
            <img src="{{ $animes->first()->image }}"></img>
        </div>
        {{-- <img class="w-1/4 flex-shrink-0 h-32" style="transform: scale(110%)" src="{{ $animes->first()->image }}"></img> --}}
        <button id="right-btn" class="h-full w-10 bg-black absolute flex items-center justify-center bg-opacity-20 top-0 right-0 z-10">
            <i class="fa fa-arrow-right absolute top-1/2 transform -translate-y-1/2 text-white"></i>
        </button>
    </div>
    <script>
        const leftButton = document.querySelector('#left-btn');
        const rightButton = document.querySelector('#right-btn');
        rightButton.addEventListener('click', rightClick);
        leftButton.addEventListener('click', leftClick);
        let visible;
        let width;
        const test = document.querySelector('.test');
        let lastPos = document.querySelectorAll('.test > img').length - visible;
        let beforeLastPos = lastPos;
        let currentPos = 0;
        let space = 2;
        init();

        window.addEventListener('resize', init)

        function init() {
            if(window.innerWidth <= 420) {
                visible = 1;
            }
            else if(window.innerWidth <= 676) {
                visible = 2;
            }
            else if(window.innerWidth <= 976) {
                visible = 3;
            }

            else {
                visible = 4;
            }

            lastPos = document.querySelectorAll('.test > img').length - visible;
            beforeLastPos = lastPos;
            width = (100 - (visible * space)) / (visible + .5)
            position();
        }


        function position() {
            let translate;
            if(currentPos != beforeLastPos) {
                rightButton.classList.remove('hidden');
            }
            if(currentPos != 0) {
                leftButton.classList.remove('hidden');
            }
            if(currentPos === 0) {
                translate = 0;
                leftButton.classList.add('hidden')
            } else if(currentPos >= beforeLastPos){
                currentPos = beforeLastPos
                translate = -beforeLastPos * width - beforeLastPos * space + width / 2 + space;
                rightButton.classList.add('hidden');
            } else {
                translate = -currentPos * width - currentPos * space
            }
            
            test.style.transform = `translateX(${translate}%)`
        }

        function rightClick() {
            currentPos++;
            position();
        }
        function leftClick() {
            rightButton.classList.remove('hidden');
            currentPos--;
            position();
        }
    </script>
</x-app-layout>