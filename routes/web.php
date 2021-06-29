<?php

use App\Http\Controllers\AnimeController;
use App\Http\Controllers\EpisodeController;

use App\Http\Controllers\SearchController;
use App\Http\Livewire\Comment;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [AnimeController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');
    
    Route::group(['middleware'=>'is_admin', 'prefix' => 'admin', 'as' => 'admin.', 'name' => 'admin.', 'namespace' => 'App\Http\Controllers\Admin'], function () {
        Route::resource('animes', 'AnimeController');
        Route::get('episodes', 'EpisodeController@all')->name('episodes.all');
        Route::resource('comments', 'CommentController')->only('index', 'show', 'destroy');
        Route::resource('users', 'UserController');
        Route::resource('animes.episodes', 'EpisodeController');
        Route::resource('genres', 'GenreController');
        Route::get('/', 'HomeController@index')->name('home');
    });
});




Route::resource('animes', AnimeController::class);
Route::resource('animes.episodes', EpisodeController::class);

Route::resource('search', SearchController::class)->only(['index', 'show']);
