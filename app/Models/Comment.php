<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'body',
        'commentable_type',
        'commentable_id',
        'user_id',
        'parent_id'
    ];


    public function commentable()
    {
        return $this->morphTo();
    }


    public function comments() {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function parent() {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
