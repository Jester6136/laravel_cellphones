<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class colors extends Model
{
    use HasFactory;
    
    protected $table = 'colors';

    public function prices() {
        return $this->hasOne(prices::class, 'colorID', 'id')->select('Price')->where('EndDate','=',NULL);
    }

    public function old_prices() {
        return $this->
        hasOne(prices::class, 'colorID', 'id')->select('Price')->
        where('EndDate','!=',null)->
        orderBy('EndDate','ASC');
    }

    public function addprice($ColorID,$Price,$date) {
        $db2 = new prices();
        $db2->ColorID = $ColorID;
        $db2->Price = $Price;
        $db2->StartDate= $date;
        $db2->save();
    }

    public function updateprice($colorID,$Price,$date) {
        $db  = prices::where('EndDate',null)->where('colorID',$colorID)->first();
        $db->EndDate = $date;
        $db->save();
        // return $db;
        $db2 = new prices();
        $db2->colorID = $colorID;
        $db2->Price = $Price;
        $db2->StartDate= $date;
        $db2->save();
    }
}
