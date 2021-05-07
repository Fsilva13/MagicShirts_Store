<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    public function clientes(){
      return $this->hasMany('App\Cliente');
    }
    
    public function tshirts(){
        return $this->belongsTo('App\Tshirt');
    }
}
