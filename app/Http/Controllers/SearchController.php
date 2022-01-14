<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    private $request;
    private $query;
    private $tab;
    private $tabButtons;
    private $order_by;

    public function index(Request $request)
    {
        $this->request = $request;

        $this
            ->searchByTitle()
            ->searchByRating()
            ->searchByGenre()
            ->searchBySelect()
            ->searchOrderBy()
            ->searchAll();
        return view('search.index', ['query' => $this->query, 'tab' => $this->tab, 'tabButtons' => $this->tabButtons]);
    }

    // QueryBuilder

    public function searchByTitle()
    {
        $q = $this->request->query()['q'] ?? '';
        $this->query = Anime::where('title', 'LIKE', "$q%");
        return $this;
    }

    private function searchByRating()
    {
        if (!isset($this->request['minrating']) || $this->request['minrating'] == 0)
            return $this;
        $request = $this->request['minrating'];

        $this->query = $this->query->withAvg('votes', 'vote')
            ->having('votes_avg_vote', '>=', $request);

        return $this;
    }


    private function searchByGenre()
    {

        if (!isset($this->request['genre']))

            return $this;
        $request = $this->request['genre'];

        $this->query = $this->query->whereHas('genres', function ($query) use ($request) {

            return $query->whereIn('genre_id', $request);
        });
        return $this;
    }


    private function searchBySelect()
    {

        $this->order_by = $this->request->order_by ?? '';

        $this->tab = $this->request->query()['tab'] ?? '';

        switch ($this->order_by) {

            case 'vote':

                $this->selectVote();

                break;

            case 'release_date':

                $this->selectReleaseDate();

                break;

            case 'upload_date':
                $this->selectUploadDate();

                break;

            default:
                $this->selectTitle();

                break;
        }

        return $this;
    }





    private function searchOrderBy()
    {
        $order_by = $this->request->order_by ?? '';
        $d = $this->request->d != null && $this->request->d === 'on' ? false : true;
        $order_by = in_array($order_by, ['vote', 'release_date', 'upload_date']) ? $order_by : 'title';
        switch ($order_by) {
            case 'vote':

                $this->query = $this->query
                    ->withAvg('votes', 'vote')
                    ->orderBy('votes_avg_vote', $d ? 'desc' : 'asc')
                    ->get()
                    ->groupBy(function ($anime) {
                        return $anime->votes->count() > 0 ? (int)$anime["votes_avg_vote"] : 'Pas de vote';
                    });

                break;
            case 'release_date':
                $this->query = $this->query->orderBy('release_date', $d ? 'desc' : 'asc')
                    ->get()
                    ->groupBy(function ($anime) {

                        return Str::ucfirst(Carbon::parse($anime->release_date)->formatLocalized('%B %Y'));
                    });

                break;
            case 'upload_date':
                // dd($this->query);
                $this->query = $this->query
                    ->orderBy('created_at', $d ? 'desc' : 'asc')
                    ->get()
                    ->groupBy(function ($anime) {

                        return Str::ucfirst($anime->created_at->formatLocalized('%B, %Y'));
                    });


                break;
            default:

                $this->query = $this->query
                    ->orderBy('title', $d ? 'asc' : 'desc')
                    ->get()
                    ->groupBy(function ($anime) {
                        return preg_match('/[a-zA-Z]/', $anime['title'][0]) ? $anime['title'][0] : 'Autres';
                    });

                break;
        }
        return $this;
    }



    private function searchAll()
    {

        $animes = $this->query;

        $mapped = [];
        foreach ($animes as $l => $anime) {
            $mapped[] = $l;
            $mapped[] = $anime;
        }
        $animes = collect(Arr::flatten($mapped, 1));


        $this->query = h_paginate_collection($animes, 30);

        return $this;
    }


    //Helpers



    /////////    SELECT FUNCTIONS         \\\\\\\\\\\\\
    private function selectVote()
    {
        $this->tabButtons = array_merge(['Tous', 'Pas de vote'], range(1, 5));
        if (strtolower($this->tab) === 'pas de vote') {

            $this->query = $this->query->withCount('votes')->having('votes_count', 0);

            return $this;
        }

        if ((int) $this->tab != 0) {
            $this->query = $this->query
                ->withAvg('votes', 'vote')
                ->having('votes_avg_vote', '>=', (int)$this->tab)
                ->having('votes_avg_vote', '<', (int)$this->tab + 1);
        }
    }

    private function selectReleaseDate()
    {
        $year = getDate()['year'];
        $year_offset = 10;
        $date_ranges = $this->generateDateRanges($year - $year_offset - 1, 10,  2);
        $date_ranges_tabs = collect($date_ranges)
            ->map(function ($dr) {
                return Arr::first($dr) . '-' . Arr::last($dr);
            })
            ->toArray();
        $last_tab_start = Arr::first(Arr::last($date_ranges)) - 1;
        $this->tabButtons = array_merge(['Tous'], range($year, $year - $year_offset), $date_ranges_tabs, ["<= $last_tab_start"]);

        if (in_array($this->tab, $this->tabButtons)) {


            if ($this->tab >= $year - $year_offset) {

                $query = $this->query->get()->filter(function ($a) {
                    return date('Y', strtotime($a->release_date)) == $this->tab;
                });
                if (count($query) > 0) {
                    $this->query = $query->toQuery();
                } else {
                    $this->query = $this->query->whereNull('id');
                }
            } else if ($this->checkRangeTab()) {
                [$start, $end] = explode('-', $this->tab);
                $query = $this->query->get()->filter(function ($a) use ($start, $end) {
                    return date('Y', strtotime($a->release_date)) >= $start && date('Y', strtotime($a->release_date)) <= $end;
                });

                if (count($query) > 0) {
                    $this->query = $query->toQuery();
                } else {
                    $this->query = $this->query->whereNull('id');
                }
            } else if ($this->tab === "<= $last_tab_start") {
                $query = $this->query->get()->filter(function ($a) use ($last_tab_start) {
                    return date('Y', strtotime($a->release_date)) <= $last_tab_start;
                });

                if (count($query) > 0) {
                    $this->query = $query->toQuery();
                } else {
                    $this->query = $this->query->whereNull('id');
                }
            }
        }
    }

    private function selectUploadDate()
    {
        $year = getDate()['year'];
        $year_count = 3;
        $date_tabs = collect(range($year, $year - $year_count - 1))->map(function ($y) {
            return ["Fin $y", "Début $y"];
        })->toArray();
        $this->tabButtons = array_merge(['Tous'], Arr::flatten($date_tabs), ['< ' . ($year - $year_count - 1)]);


        if (in_array($this->tab, $this->tabButtons)) {
            if (Str::startsWith($this->tab, 'Fin')) {
                $tab_year = Str::substr($this->tab, -4);
                $this->query = $this->query->whereBetween('created_at', [date("$tab_year-07-01"), date("$tab_year-12-31")]);
            } else if ((Str::startsWith($this->tab, 'Début'))) {

                $tab_year = Str::substr($this->tab, -4);
                $this->query = $this->query->whereBetween('created_at',  [date("$tab_year-01-01"), date("$tab_year-06-30")]);
            } elseif ($this->tab != "Tous") {
                $this->query = $this->query->whereYear('created_at', '<', $year - $year_count - 1);
            }
        }
    }


    private function selectTitle()
    {
        $this->tabButtons = array_merge(['Tous', 'Autres'], range('a', 'z'));
        if (strtolower($this->tab) === 'autres') {
            $this->query = $this->query->where('title', 'regexp', '^[0-9]');
            return $this;
        }
        if (!in_array(strtolower($this->tab), $this->tabButtons)) {

            $this->tab = '';
        }
        $this->query = $this->query->where('title', 'LIKE', "$this->tab%");
    }




    private function checkRangeTab()
    {

        $tab = $this->request->tab;
        if (!$tab || strlen($tab) === 0)
            return false;
        $range = explode('-', $tab);
        if (count($range) != 2 || !h_is_integer($range[0], false) && !h_is_integer($range[1], false))
            return false;
        if ($range[0] > $range[1])
            return false;
        return true;
    }




    private function generateDateRanges($start, $length, $count)
    {
        $date_ranges = [];
        for ($i = 0; $i < $count; $i++, $start -= $length) {
            $date_ranges[] = range($start - $length + 1, $start);
        }
        return $date_ranges;
    }
}