<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

	protected $fillable = [
       'id','nif', 'endereco', 'tipo_pagamento', 'ref_pagamento', 
    ];

    public function encomendas(){
        return $this->haMany('App\Encomenda');
    }

    public function user(){
        return $this->belongsTo('App\User', 'id');
    }
    public function estampas(){
		return $this->hasMany('App\Estampa');
	}
}
