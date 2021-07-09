<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anime extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'title',
        'release_date',
        'synopsis',
        'image',
        'studio'
    ];

   public static function boot() {
       parent::boot();

       static::deleted(function($anime) {
        $anime->episodes()->delete();
       });

       static::restored(function($anime) {
            $anime->episodes()->restore();
       });
   }

    protected $primaryKey = 'id';

    public $incrementing = false;

    public function episodes() {
        return $this->hasMany(Episode::class);
    }

    public function genres() {
        return $this->belongsToMany(Genre::class)->withTimestamps();
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function votes() {
        return $this->hasMany(Vote::class);
    }

   
}
