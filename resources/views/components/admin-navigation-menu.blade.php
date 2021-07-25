<div class="mb-10"></div>

<nav class="w-full bg-gray-800 text-gray-100 fixed top-0" style="z-index: 9999" x-data="{open:false, show:false}">
    <div class="hidden md:flex px-4 h-10 ">
        <div class="table">
            <a href="{{ h_isAdminRoute() ? route('home') : route('admin.home') }}"
                class="table-cell align-middle hover:text-blue-400">{{ h_isAdminRoute() ? 'Front office' : 'Back office'}}</a>
        </div>
        <div class="hidden md:flex space-x-4 ml-10">
            <div class="relative table mr-0 collapse" style="z-index: 9999" @mouseenter="show=true"
                @mouseleave="show=false">
                <a href="#" class="table-cell align-middle hover:text-blue-400 px-5">Créer</a>
                <ul @mouseenter="show=true" x-show="show"
                    class="inline-block absolute bottom-0 transform translate-y-full left-0 bg-gray-700 p-2 mt-2 w-32">
                    <li>
                        <a href="{{ route('admin.animes.create') }}"
                            class="hover:text-blue-400 inline-block w-full">Anime</a>
                    </li>

                    <li>
                        <a href="{{ route('admin.genres.create') }}"
                            class="hover:text-blue-400 inline-block w-full">Genre</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.create') }}"
                            class="hover:text-blue-400 inline-block w-full">Compte</a>
                    </li>
                </ul>
            </div>
            <div class="table" style="margin-left: 0">
                @foreach(h_adminRouteNavigationMenu() as $route)
                <a href="{{ $route['link'] }}"
                    class="table-cell align-middle px-5 hover:text-blue-400">{{ $route['text'] }}</a>
                @endforeach
            </div>
        </div>
    </div>
    {{-- Reponsive --}}
    <div class="md:hidden mr-6 flex">
        <div class="table ml-6">
            <a href="{{ h_isAdminRoute() ? route('home') : route('admin.home') }}"
                class="table-cell align-middle hover:text-blue-400">{{ h_isAdminRoute() ? 'Front office' : 'Back office'}}</a>
        </div>
        <div class="-mr-2 flex items-center md:hidden ml-auto">
            <button @click="open = ! open"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

    </div>
    <div x-show="open" class="w-full md:hidden">
        <div class="relative block text-center w-full" style="z-index: 9999" @click="show= !show">
            <div class="hover:text-blue-400 px-5 cursor-pointer">Créer <span class="fa text-sm"
                    :class="show ? 'fa-minus' : 'fa-plus'"></span></div>
            <ul x-show="show" class="block ml-4 text-red-100 mb-2">
                <li>
                    <a href="{{ route('admin.animes.create') }}" class="hover:text-blue-400 w-full">Anime</a>
                </li>

                <li>
                    <a href="{{ route('admin.genres.create') }}" class="hover:text-blue-400 w-full">Genre</a>
                </li>
                <li>
                    <a href="{{ route('admin.users.create') }}" class="hover:text-blue-400 w-full">Compte</a>
                </li>
            </ul>
            <div>
                @foreach(h_adminRouteNavigationMenu() as $route)
                <a href="{{ $route['link'] }}"
                    class="block px-5 hover:text-blue-400 mb-1">{{ $route['text'] }}</a>
                @endforeach
            </div>
        </div>
    </div>
    {{-- <div x-show="open">abc</div>
    <div class="block bg-gray-800">
        abc

    </div> --}}
</nav>
<div class="mb-24 md:mb-0"></div>
