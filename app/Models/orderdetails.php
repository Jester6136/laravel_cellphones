<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderdetails extends Model
{
    use HasFactory;

    public function color(){
        return $this->hasOne(colors::class,'id','ColorID');
    }
}
