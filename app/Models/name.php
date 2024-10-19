<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class name extends Model
{
    use HasFactory;
    protected  $table='names';
    protected $guarded=[];

    public function phone() {
        return $this->hasMany(Phone::class);
    }
    
}
 