<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    use HasFactory;

    public function cart() {
        return $this->hasMany(cart::class, 'CustomerID', 'id');
    }
}
