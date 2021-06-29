<div class="bg-blue-500 w-44 min-h-screen">
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
            <a href="{{ route('admin.episodes.all')}}" class="w-full text-lg font-bold inline-block pl-3 py-3">Episodes</a>
        </li>
        <li class="hover:bg-gray-100 hover:text-blue-600 border-l-8 border-transparent hover:border-gray-700">
            <a href="{{ route('admin.comments.index')}}" class="w-full text-lg font-bold inline-block pl-3 py-3">Commentaires</a>
        </li>
        <li x-data="{show: false}" @mouseenter="show=true" @mouseleave="show=false" class="relative hover:bg-gray-100 hover:text-blue-600 border-l-8 border-transparent hover:border-gray-700">
            <a href="{{ route('admin.users.index') }}" class="w-full text-lg font-bold inline-block pl-3 py-3">Comptes</a>
                <ul x-show="show" class="absolute top-0 right-0 transform translate-x-full bg-blue-500 border-l-4 border-gray-900 text-blue-100 font-weight-bolder w-48">
                    <li class="hover:text-gray-800"><a class="px-3 py-2 pt-3 inline-block w-full" href="{{ route('admin.users.index') }}">Tous les comptes</a></li>
                    <li class="hover:text-gray-800"><a class="px-3 py-2 pb-3 inline-block w-full" href="{{ route('admin.users.create') }}">Créer un compte</a>
                    </li>
                </ul>
        </li>
    </ul>    
</div>
