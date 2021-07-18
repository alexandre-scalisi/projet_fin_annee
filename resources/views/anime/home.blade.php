<x-app-layout>
    <h1 class="text-2xl font-bold border-b-4 border-indigo-700"> Accueil</h1>
    <p class="mt-4 mb-8 text-xl">
        Bienvenue
    @auth
         {{ auth()->user()->name }}
    @else
        invité
    @endauth
    </p>
    <x-slider title="Nos nouveautés" :new_animes="$new_animes" slider="slider1"/>
    <x-slider title="Les plus populaires" :new_animes="$top_rated_animes" slider="slider2"/>
    <x-slider title="Anime d'action" :new_animes="$action_animes" slider="slider3"/>
    <x-slider title="Selection aléatoire" :new_animes="$random_animes" slider="slider4"/>
</x-app-layout>