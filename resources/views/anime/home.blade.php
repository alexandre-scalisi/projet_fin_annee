<x-app-layout>
    <x-title>Accueil</x-title>
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