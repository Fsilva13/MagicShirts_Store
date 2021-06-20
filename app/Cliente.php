<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;
    
	protected $fillable = [
       'id','nif', 'endereco', 'tipo_pagamento', 'ref_pagamento', 
    ];

    public function encomendas(){
        return $this->hasMany('App\Encomenda');
    }

    public function user(){
        return $this->belongsTo('App\User', 'id');
    }
    public function estampas(){
		return $this->hasMany('App\Estampa');
	}
}
