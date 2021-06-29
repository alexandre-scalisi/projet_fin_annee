<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'release_date',
        'synopsis',
        'image',
        'studio'
    ];

    protected $primaryKey = 'id';

    public $incrementing = false;

    public function episodes() {
        return $this->hasMany(Episode::class);
    }

    public function genres() {
        return $this->belongsToMany(Genre::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function votes() {
        return $this->hasMany(Vote::class);
    }

   
}
