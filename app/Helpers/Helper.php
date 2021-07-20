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

function h_sort_table($order_by, $dir) {
    $route = Route::currentRouteName();
    $request_orderby = request('order_by');

    if($request_orderby != $order_by)
        return route($route, array_merge(request()->all(), compact('order_by', 'dir')));
    
    if(request('dir') && request('dir') === 'asc')
        $dir = 'desc';
    else if(request('dir') && request('dir') === 'desc')
        $dir = 'asc';
    
    return route($route, array_merge(request()->all(), compact('order_by', 'dir')));
    
}

function h_sortArrow($col) {
    // recuperer la requete
    // recuper orderby
    //recuperer direction
    $order_by = request('order_by');
    if($order_by !==$col)
    return '';
    $dir = request('dir');
   
    return $dir === 'desc' ? 'fa fa-arrow-down' : 'fa fa-arrow-up';
    
}

function h_truncate ($str, $max_length) {
    if(strlen($str) < $max_length)
        return $str;
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
    return asset('public/storage/images/'.$path);
}

function h_isAdminRoute() {
    return Illuminate\Support\Facades\Request::segment(1) === 'admin';
}

function h_format_date_short($date) {
    return Carbon\Carbon::parse( $date)->format('d-m-y');
}

function h_paginate_collection($collection, $per_page) {
    $total = $collection->count();
    $current_page = request('page') ?? 1;
    $starting_point = ($current_page * $per_page) - $per_page;
    $array = $collection->slice($starting_point, $per_page, true);
    return new Illuminate\Pagination\LengthAwarePaginator($array, $total, $per_page, $current_page, [
        'path' => url()->current(),
        'query' => request()->query(),
    ]);
}