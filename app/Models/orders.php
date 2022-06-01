<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;

    public function orderdetails() {
        return $this->hasMany(orderdetails::class, 'OrderID', 'id');
    }
    public function customer(){
        return $this->hasOne(customers::class,'id','CustomerID');
    }
}
