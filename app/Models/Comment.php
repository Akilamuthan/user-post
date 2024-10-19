<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use App\Models\Post;

class Comment extends Model
{
    use HasFactory,softDeletes;
    protected $guarded = [];

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}
