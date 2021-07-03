<?php


function h_calculateStars($anime_id) {
    $anime = App\Models\Anime::find($anime_id);
    $full_vote = $anime->votes->avg('vote') ?? 0;
    $full_stars = (int) $full_vote;
    $half_stars = $full_vote - $full_stars >= .5 ? 1 : 0;
    $empty_stars = 5 - $full_stars - $half_stars;  
    $votes_count = $anime->votes->count();
    $votes_avg = round($anime->votes->avg('vote'), 2);
    return compact('full_stars', 'half_stars', 'empty_stars', 'votes_count', 'votes_avg');
}

function h_is_integer($var, $strict=true) {
    if($strict)
        return is_numeric($var) && (int) $var === $var;
    return is_numeric($var) && (int) $var == $var;
}

function h_sort_table($param, $default = 'asc') {
    if(!in_array($param, request()->input())) {
        return url()->current().'?order_by='.$param.'&dir='.$default;
    }
    else if (request()->input()['dir'] == "desc") {
        return url()->current().'?order_by='.$param.'&dir=asc';
    }
    

    return url()->current().'?order_by='.$param.'&dir=desc';
    
}

function h_truncate ($str, $max_length) {

    $strArr = explode(' ', $str);
    if(count($strArr)< 2) 
        return $str;
    return array_reduce($strArr, function($a, $b) use($max_length) { 
        return strlen($a) < $max_length ? $a . ' ' . $b : $a;
    }) . ' ...';
}

function h_find_image($path) {
    if(Illuminate\Support\Str::startsWith($path, 'http')) {
        return $path;
    }
    return asset('storage/images/'.$path);
}