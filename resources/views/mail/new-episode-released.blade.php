<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
</head>
<body>
    <img src="{{ $episode->anime->image }}" class="w-full">
    <p>{{ $user->name }}, {{ $episode->title }} est enfin sorti !</p>
    <a href="{{ route('animes.episodes.show', [$episode->anime->id, $episode->id]) }}">Cliquez ici pour voir l'épisode !</a>
</body>
</html>