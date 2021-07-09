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

Route::get('/dashboard', function() {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    
    
    Route::group(['middleware'=>'is_admin', 'prefix' => 'admin', 'as' => 'admin.', 'name' => 'admin.', 'namespace' => 'App\Http\Controllers\Admin'], function () {
        Route::get('animes/trashed', 'AnimeController@trashed')->name('animes.trashed');
        Route::delete('animes/trashed', 'AnimeController@forceDelete')->name('animes.forceDelete');
        Route::post('animes/trashed', 'AnimeController@restore')->name('animes.restore');
        Route::resource('animes', 'AnimeController');
        Route::get('episodes', 'EpisodeController@index')->name('episodes.index');
        Route::get('episodes/trashed', 'EpisodeController@trashed')->name('episodes.trashed');
        Route::delete('episodes/trashed', 'EpisodeController@forceDelete')->name('episodes.forceDelete');
        Route::post('episodes/trashed', 'EpisodeController@restore')->name('episodes.restore');
        Route::resource('animes.episodes', 'EpisodeController');
        Route::get('comments/trashed', 'CommentController@trashed')->name('comments.trashed');
        Route::delete('comments/trashed', 'CommentController@forceDelete')->name('comments.forceDelete');
        Route::post('comments/trashed', 'CommentController@restore')->name('comments.restore');
        Route::resource('comments', 'CommentController')->only('index', 'show', 'destroy');
        Route::get('users/trashed', 'UserController@trashed')->name('users.trashed');
        Route::delete('users/trashed', 'UserController@forceDelete')->name('users.forceDelete');
        Route::post('users/trashed', 'UserController@restore')->name('users.restore');
        Route::resource('users', 'UserController');
        Route::get('genres/trashed', 'GenreController@trashed')->name('genres.trashed');
        Route::delete('genres/trashed', 'GenreController@forceDelete')->name('genres.forceDelete');
        Route::post('genres/trashed', 'GenreController@restore')->name('genres.restore');
        Route::resource('genres', 'GenreController');
        Route::get('/', 'HomeController@index')->name('home');
    });
});




Route::resource('animes', AnimeController::class);
Route::resource('animes.episodes', EpisodeController::class);

Route::resource('search', SearchController::class)->only(['index', 'show']);
Route::match(['GET', 'POST', 'PATCH'], '/test');