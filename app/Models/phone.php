<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phone extends Model
{
    use HasFactory;
    protected  $table='phones';
    protected $guarded=[];

    public function name() {
        return $this->belongsTo(Name::class); // Adjust if your foreign key is different
    }
    
    
    
}
