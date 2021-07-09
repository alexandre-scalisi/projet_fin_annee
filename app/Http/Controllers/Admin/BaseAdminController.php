<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

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
    
    protected function trashed() {
        $this->indexAndRestoreHelper($this->model::onlyTrashed());
        $this->arr['routes'] = $this->getRoutes(['forceDelete', 'restore']);
        
        return view('admin.'.$this->lc_plural_model.'.trashed', $this->arr);
    }
    
    
    protected function destroy()
    {
        
        $deletes = request('delete');
        if(!$deletes)
        return redirect()->back();
        
        $this->model::whereIn('id', $deletes)->delete();
        
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
        
        $this->model::onlyTrashed()->where('id', $restores)->restore();
        
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
    
    
    
    
    protected function indexAndRestoreHelper($model) {
        dd('test');
        $this->accepted_order_bys = ['title', 'release_date', 'created_at', 'vote', 'episodes'];
        $this->default_order_by = 'title';
        $this->arr['objects'] = $this->search($model, $this->accepted_order_bys, $this->default_order_by);
    }
    
    
    ////////////////////////  SEARCH METHODS  \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    protected function search($model, $accepted_order_bys, $default_order_by) {
        $order_by = lcfirst(request()->input('order_by', $default_order_by));
        $order_by = in_array( $order_by, $accepted_order_bys) ? $order_by : $default_order_by;
        
        $dir = lcfirst(request()->input('dir', 'asc')) === 'desc' ? 'desc' : 'asc';
        $special_order_bys = ["author", "email", "vote", "episodes"];
        
        if(in_array($order_by, $special_order_bys) && $this->model_name != 'User') {
            return $this->specialSearch($model, $order_by, $dir)->paginate($this->per_page);
        }

        return $model->orderBy($order_by, $dir)->paginate($this->per_page);
    }
    
    
    //helper for search function
    private function specialSearch($model, $order_by, $dir) {
        
        if($order_by === "name" || $order_by === "email") {
            return $model->join('users', 'users.id', '=', "$this->lc_plural_model.user_id")
            ->select("$this->lc_plural_model.*", 'users.'.$order_by)
            ->orderBy($order_by, $dir);
        }
        
        if($order_by === 'vote') {
            
            return $model->withAvg('votes', 'vote')->orderBy('votes_avg_vote', $dir);
            
        }
        else if($order_by == "episodes") {
            return $model->withCount('episodes')->orderBy('episodes_count', $dir);
        }
    }
    
}
