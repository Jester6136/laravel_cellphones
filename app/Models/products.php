<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $table = 'products';

    public function categories(){
        return $this->belongsTo(categories::class,'CategoryID','id');
    }

    public function brands(){
        return $this->belongsTo(brands::class,'BrandID','id');
    }

    public function memories(){
        return $this->hasMany(memories::class,'ProductID','id');
    }
}
