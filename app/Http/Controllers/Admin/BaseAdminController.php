<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

abstract class BaseAdminController extends Controller
{
    protected $model_name;
    
    protected function __construct() {
        $this->model = 'App\\Models\\'.$this->model_name;
        $this->lc_plural_model = Str::plural(Str::lower($this->model_name));
    }

    protected function counts() {

        
        $withoutTrashedCount = $this->model::all()->count();
        $trashedCount = $this->model::onlyTrashed()->count();
        
        return compact('withoutTrashedCount', 'trashedCount' );
    }
    
    protected function getRoutes(...$routes) {
        $finalRoutes = ['index' => route("admin.$this->lc_plural_model.index"),
                        'trash' => route("admin.$this->lc_plural_model.trashed")];
        foreach($routes as $route) {
            $finalRoutes[$route] = "admin.$this->lc_plural_model.$route";
        }

        return $finalRoutes;
    }
    protected function search($model, $accepted_order_bys, $default_order_by) {
        $order_by = lcfirst(request()->input('order_by', $default_order_by));
        $dir = lcfirst(request()->input('dir', 'asc'));
 
        $accepted_dirs =['asc', 'desc'];
        if(!in_array($order_by, $accepted_order_bys))
            $order_by = 'title';
        if(!in_array($dir, $accepted_dirs))
            $dir = 'asc';
        if($order_by === 'vote') {
            
            return $model->withAvg('votes', 'vote')->orderBy('votes_avg_vote', $dir)->paginate(20);

        }
        else if($order_by == "episodes") {
            return $model->withCount('episodes')->orderBy('episodes_count', $dir)->paginate(20);
        }
        
      
        return $model->orderBy($order_by, $dir)->paginate(20);
    }


}
