<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function encomendas(){
        return $this->haMany('App\Encomenda');
    }

    public function users(){
        return $this->belongsTo('App\User', 'id');
    }
    public function estampas(){
		return $this->hasMany('App\Estampa');
	}
}
