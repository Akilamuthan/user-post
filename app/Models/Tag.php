<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Laravel\Passport\HasApiTokens;
use App\Models\Post;

class Tag extends Model
{
    use HasFactory,SoftDeletes,HasApiTokens;
    protected $guarded=[];
    
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
