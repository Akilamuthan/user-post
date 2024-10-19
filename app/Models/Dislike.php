<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Dislike extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}
