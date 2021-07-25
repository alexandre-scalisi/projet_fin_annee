<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;

class Episode extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable = [
        'title',
        'adn',
        'crunchyroll',
        'wakanim',
        'anime_id'
    ];

    public static function boot() {
        parent::boot();
 
        self::created(function($episode) {
         $episode->anime->registeredUsers->each(function($user) use($episode){
            Mail::to($user->email)->send(new \App\Mail\NewEpisodeReleasedNotification($user, $episode));
         });
        });
 
    }

    public function anime() {
        return $this->belongsTo(Anime::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function links() {
        // Court mais long lol
            // return collect($this->get(['im', 'adn', 'crunchyroll'])[1])->reject(function($k) {return $k === null;});
        $links = [];
        if($this->adn != null) $links['adn'] = $this->adn;
        if($this->crunchyroll != null) $links['crunchyroll'] = $this->crunchyroll;
        if($this->wakanim != null) $links['wakanim'] = $this->wakanim;
        return $links;
    }
}
