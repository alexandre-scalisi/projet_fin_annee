<?php


function calculateStars($id) {
    $anime = App\Models\Anime::find($id);
    $full_vote = $anime->votes->avg('vote') ?? 0;
    $full_stars = (int) $full_vote;
    $half_stars = $full_vote - $full_stars > .5 ? 1 : 0;
    $empty_stars = 5 - $full_stars - $half_stars;  
    $votes_count = $anime->votes->count();

    return compact('full_stars', 'half_stars', 'empty_stars', 'votes_count');
}