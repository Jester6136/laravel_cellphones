<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class memories extends Model
{
    use HasFactory;
    protected $table = 'memories';

    public function colors(){
        return $this->hasMany(colors::class,'MemoryID','id')->where('is_active',1);
    }
}
