<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    public function clientes(){
      return $this->belongsTo('App\Cliente');
    }
    
    public function tshirts(){
        return $this->hasMany('App\Tshirt');
    }
}
