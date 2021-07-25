<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Route;

abstract class BaseAdminController extends Controller
{
    protected $per_page;
    protected $arr;
    protected $model_name;
    protected $lc_plural_model;
    
    protected function __construct() {
        $this->model = 'App\\Models\\'.$this->model_name;
        $this->arr = $this->counts();
        $this->lc_plural_model = Str::plural(Str::lower($this->model_name));
        $this->per_page = 20;
    }
    
    protected function counts() {
        
        
        $withoutTrashedCount = $this->model::all()->count();
        $trashedCount = $this->model::onlyTrashed()->count();
        
        return compact('withoutTrashedCount', 'trashedCount' );
    }

    protected function index() {
        $this->model = $this->model::withoutTrashed();   
 
        $this->search();
        if(request('q') && !request('order_by')) {
            $this->orderByQuery();
        } else {
            $this->arr['objects'] =$this->orderBy();
        }

        return view('admin.'.$this->lc_plural_model.'.index', $this->arr);
    }
    
    protected function trashed() {
        array_push($this->accepted_order_bys, 'deleted_at');
        $this->model = $this->model::onlyTrashed();
        $this->search();
        if(request('q') && !request('order_by')) {
            $this->orderByQuery();
        } else {
            $this->arr['objects'] = $this->orderBy();
        }
        $this->arr['routes'] = $this->getRoutes(['forceDelete', 'restore']);
        return view('admin.'.$this->lc_plural_model.'.trashed', $this->arr);
    }
    
    
    protected function destroy()
    {
        
        $deletes = request('delete');
        if(!$deletes)
            return redirect()->back();

        $this->model::whereIn('id', $deletes)->each(function ($m) {
            $m->delete();
        });
        $previous_url_exploded = explode('/', url()->previous());
        
        if($previous_url_exploded[count($previous_url_exploded) - 1] !== "trashed")
            return redirect(route('admin.'.$this->lc_plural_model.'.index'));
        
        return redirect()->back()->with('success', $this->model_name.'(s) supprimé(s) avec succès');
    }
    
    
    protected function forceDelete()
    {
        $deletes = request('delete');
        if(!$deletes)
        return redirect()->back();
        
        $this->model::onlyTrashed()->whereIn('id', $deletes)->forceDelete();
        return redirect()->back()->with('success', $this->model_name.'(s) définitivement supprimé(s) avec succès');
    }
    
    
    
    protected function restore()
    {
        $restores = request('restore');
        
        if(!$restores)
        return redirect()->back();
        
        $this->model::onlyTrashed()->whereIn('id', $restores)->restore();
        
        return redirect()->back()->with('success', $this->model_name.'(s) restauré(s) avec succès');
    }
    
    
    
    
    protected function getRoutes($routes, $nested = [], $nested_model='' ) {
        $finalRoutes = ['index' => route("admin.$this->lc_plural_model.index"),
        'trash' => route("admin.$this->lc_plural_model.trashed")];
        
        foreach($routes as $route) {
            $finalRoutes[$route] = "admin.$this->lc_plural_model.$route";
        }
        
        if($nested) {
            foreach ($nested as $nest) {
                $finalRoutes[$nest] = "admin.$nested_model.$this->lc_plural_model.$nest";
            }
        }
        
        return $finalRoutes;
    }
    
    
    
    ////////////////////////  Order by METHODS  \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    protected function orderBy() {
        $order_by = lcfirst(request()->input('order_by', $this->default_order_by));
        $order_by = in_array( $order_by, $this->accepted_order_bys) ? $order_by : $this->default_order_by;
        
        $dir = lcfirst(request()->input('dir', 'asc')) === 'desc' ? 'desc' : 'asc';
        $special_order_bys = ["author", "email", "vote", "episodes"];
        
        if(in_array($order_by, $special_order_bys) && $this->model_name != 'User') {
            return $this->specialOrderBy($order_by, $dir)->paginate($this->per_page);
        }
        if($order_by == 'title') {
            return h_paginate_collection($this->model->get()->sortBy('title', SORT_NATURAL, $dir == 'desc' ? true : false), $this->per_page);
        }
        
        return $this->model->orderBy($order_by, $dir)->paginate($this->per_page);
    }
    
    
    //helper for Order by method
    private function specialOrderBy($order_by, $dir) {
        
        if($order_by === "name" || $order_by === "email") {
            return $this->model->join('users', 'users.id', '=', "$this->lc_plural_model.user_id")
            ->select("$this->lc_plural_model.*", 'users.'.$order_by)
            ->orderBy($order_by, $dir);
        }
        
        if($order_by === 'vote') {
            
            return $this->model->withAvg('votes', 'vote')->orderBy('votes_avg_vote', $dir);
            
        }
        else if($order_by == "episodes") {
            
            return $this->model->withCount('episodes')->orderBy('episodes_count', $dir);
        }
    }

    protected function search() {
        $q = request('q');

        if($q === null)
            return;
        $array_words = explode(' ', $q);
        $new = collect($array_words)->reduce(function($a, $b) {
            return $a . "%$b%";
        });

        
        $this->model = $this->model->where($this->default_order_by, 'LIKE', "%$new%");
    }

    protected function orderByQuery() {
     
        $first_letter = request('q')[0] ?? '';
        $collections = $this->model->get()->groupBy(function($a) use($first_letter){
            return ucfirst($a[$this->default_order_by][0]) === ucfirst($first_letter);
        });
        
        $firstLetterCollection = $collections[1] ?? collect([]);
        $restCollection = $collections[0] ?? collect([]);
        if(empty($restCollection)) {
            return;
        }
        $restCollection = $restCollection->sortBy($this->default_order_by);
        
        if(!empty($firstLetterCollection)) 
        $firstLetterCollection = $firstLetterCollection->sortBy($this->default_order_by, SORT_NATURAL, false);
        $array = $firstLetterCollection->merge($restCollection);
        $this->arr['objects'] = h_paginate_collection($array, $this->per_page);
        
    }
    
}
