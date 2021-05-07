<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    public function tshirts{
        return $this->hasMany('App\Encomenda');
    }
}
