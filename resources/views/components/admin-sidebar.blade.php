<div class="bg-blue-500 w-44 min-h-screen hidden md:block fixed">
    <ul>
        <li class="hover:bg-gray-100 hover:text-blue-600 border-l-8 border-transparent hover:border-gray-700">
            <a href="{{ route('admin.home') }}" class="w-full text-lg font-bold inline-block pl-3 py-3">Accueil</a>
        </li>
        @foreach (['animes', 'genres'] as $item)
            <li x-data="{show: false}" @mouseenter="show=true" @mouseleave="show=false" class="relative hover:bg-gray-100 hover:text-blue-600 border-l-8 border-transparent hover:border-gray-700">
                <a href="{{ route('admin.'.$item.'.index') }}" class="w-full text-lg font-bold inline-block pl-3 py-3">{{ Str::ucfirst($item) }}</a>
                    <ul x-show="show" class="absolute top-0 right-0 transform translate-x-full bg-blue-500 border-l-4 border-gray-900 text-blue-100 font-weight-bolder w-48">
                        <li class="hover:text-gray-800"><a class="px-3 py-2 pt-3 inline-block w-full" href="{{ route('admin.'.$item.'.index') }}">Tous les {{ $item }}</a></li>
                        <li class="hover:text-gray-800"><a class="px-3 py-2 pb-3 inline-block w-full" href="{{ route('admin.'.$item.'.create') }}">Créer un {{ Str::singular($item) }}</a>
                        </li>
                    </ul>
            </li>
        @endforeach
        <li class="hover:bg-gray-100 hover:text-blue-600 border-l-8 border-transparent hover:border-gray-700">
            <a href="{{ route('admin.episodes.index')}}" class="w-full text-lg font-bold inline-block px-3 py-3">Episodes</a>
        </li>
        <li class="hover:bg-gray-100 hover:text-blue-600 border-l-8 border-transparent hover:border-gray-700">
            <a href="{{ route('admin.comments.index')}}" class="w-full text-lg font-bold inline-block px-3 py-3">Commentaires</a>
        </li>
        <li x-data="{show: false}" @mouseenter="show=true" @mouseleave="show=false" class="relative hover:bg-gray-100 hover:text-blue-600 border-l-8 border-transparent hover:border-gray-700">
            <a href="{{ route('admin.users.index') }}" class="w-full text-lg font-bold inline-block px-3 py-3">Comptes</a>
                <ul x-show="show" class="absolute top-0 right-0 transform translate-x-full bg-blue-500 border-l-4 border-gray-900 text-blue-100 font-weight-bolder w-48">
                    <li class="hover:text-gray-800"><a class="px-3 py-2 pt-3 inline-block w-full" href="{{ route('admin.users.index') }}">Tous les comptes</a></li>
                    <li class="hover:text-gray-800"><a class="px-3 py-2 pb-3 inline-block w-full" href="{{ route('admin.users.create') }}">Créer un compte</a>
                    </li>
                </ul>
        </li>
        <li class="relative hover:bg-gray-100 hover:text-blue-600 border-l-8 border-transparent hover:border-gray-700 mt-6">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-lg font-bold inline-block px-3 py-3 text-left">Déconnexion</button>
            </form>
            
        </li>
    </ul>    
</div>

<div class="w-full bg-blue-500 flex flex-wrap py-4 md:hidden fixed top-10" x-data="{modal: false}" style="z-index: 9999">
    <button class="fa fa-bars ml-auto mr-6 text-2xl" :class="{'fa-times text-indigo-800' : modal}"@click.prevent="modal=!modal"></button>
    <div class="w-full" x-show="modal">
        <ul class="text-center py-2">
            <li class="hover:bg-gray-100 hover:text-blue-600 border-l-8 border-transparent hover:border-gray-700">
                <a href="{{ route('admin.home') }}" class="w-full text-lg font-bold inline-block pl-3 py-3">Accueil</a>
            </li>
            @foreach (['animes', 'genres'] as $item)
                <li x-data="{show: false}" @mouseenter="show=true" @mouseleave="show=false" class="relative hover:bg-gray-100 hover:text-blue-600 border-l-8 border-transparent hover:border-gray-700">
                    <a href="{{ route('admin.'.$item.'.index') }}" class="w-full text-lg font-bold inline-block pl-3 py-3">{{ Str::ucfirst($item) }}</a>
                        <ul x-show="show" class="absolute top-0 right-0 transform translate-x-full bg-blue-500 border-l-4 border-gray-900 text-blue-100 font-weight-bolder w-48">
                            <li class="hover:text-gray-800"><a class="px-3 py-2 pt-3 inline-block w-full" href="{{ route('admin.'.$item.'.index') }}">Tous les {{ $item }}</a></li>
                            <li class="hover:text-gray-800"><a class="px-3 py-2 pb-3 inline-block w-full" href="{{ route('admin.'.$item.'.create') }}">Créer un {{ Str::singular($item) }}</a>
                            </li>
                        </ul>
                </li>
            @endforeach
            <li class="hover:bg-gray-100 hover:text-blue-600 border-l-8 border-transparent hover:border-gray-700">
                <a href="{{ route('admin.episodes.index')}}" class="w-full text-lg font-bold inline-block px-3 py-3">Episodes</a>
            </li>
            <li class="hover:bg-gray-100 hover:text-blue-600 border-l-8 border-transparent hover:border-gray-700">
                <a href="{{ route('admin.comments.index')}}" class="w-full text-lg font-bold inline-block px-3 py-3">Commentaires</a>
            </li>
            <li x-data="{show: false}" @mouseenter="show=true" @mouseleave="show=false" class="relative hover:bg-gray-100 hover:text-blue-600 border-l-8 border-transparent hover:border-gray-700">
                <a href="{{ route('admin.users.index') }}" class="w-full text-lg font-bold inline-block px-3 py-3">Comptes</a>
                    <ul x-show="show" class="absolute top-0 right-0 transform translate-x-full bg-blue-500 border-l-4 border-gray-900 text-blue-100 font-weight-bolder w-48">
                        <li class="hover:text-gray-800"><a class="px-3 py-2 pt-3 inline-block w-full" href="{{ route('admin.users.index') }}">Tous les comptes</a></li>
                        <li class="hover:text-gray-800"><a class="px-3 py-2 pb-3 inline-block w-full" href="{{ route('admin.users.create') }}">Créer un compte</a>
                        </li>
                    </ul>
            </li>
            <li class="relative hover:bg-gray-100 hover:text-blue-600 border-l-8 border-transparent hover:border-gray-700 mt-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-lg font-bold inline-block px-3 py-3 text-center">Déconnexion</button>
                </form>
                
            </li>
        </ul>    
    </div>
</div>