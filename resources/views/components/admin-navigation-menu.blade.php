<div class="mb-10"></div>
<div class="h-10 w-full bg-gray-800 flex text-gray-100 px-4 fixed top-0" style="z-index: 9999">
    <div class="table">
    <a href="{{ h_isAdminRoute() ? route('home') : route('admin.home') }}" class="table-cell align-middle hover:text-blue-400">{{ h_isAdminRoute() ? 'Front office' : 'Back office'}}</a>
    </div>
    <div class="flex space-x-4 ml-10">
        <div class="relative table mr-0 collapse" style="z-index: 9999" x-data="{show: false}" @mouseenter="show=true" @mouseleave="show=false">
            <a href="#" class="table-cell align-middle hover:text-blue-400 px-5">Créer</a>
            <ul   @mouseenter="show=true" x-show="show" class="inline-block absolute bottom-0 transform translate-y-full left-0 bg-gray-700 p-2 mt-2 w-32">
                <li>
                    <a href="{{ route('admin.animes.create') }}" class="hover:text-blue-400 inline-block w-full">Anime</a>
                </li>
                
                <li>
                    <a href="{{ route('admin.genres.create') }}" class="hover:text-blue-400 inline-block w-full">Genre</a>
                </li>
                <li>
                    <a href="{{ route('admin.users.create') }}" class="hover:text-blue-400 inline-block w-full">Compte</a>
                </li>
            </ul>
        </div>
        <div class="table" style="margin-left: 0">
            @foreach(h_adminRouteNavigationMenu() as $route)
            <a href="{{ $route['link'] }}" class="table-cell align-middle px-6 hover:text-blue-400">{{ $route['text'] }}</a>
            @endforeach
        </div>
    </div>
</div>
<div class="mb-24 md:mb-0"></div>