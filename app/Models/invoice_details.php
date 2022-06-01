<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice_details extends Model
{
    use HasFactory;
    public function color(){
        return $this->hasOne(colors::class,'id','colorID')->where('is_active',1);
    }
}
