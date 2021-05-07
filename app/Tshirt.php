<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    public function tshirts(){
        return $this->hasMany('App\Encomenda');
    }
   public function estampa(){
		return $this->belongsTo('App\Estampa');
	}

	public function cor(){
		return $this->belongsTo('App\Cor');
	}
}
