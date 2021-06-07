<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    public function anime() {
        return $this->belongsTo(Anime::class);
    }

    public function video_links() {
        return $this->hasMany(VideoLink::class);
    }
}
