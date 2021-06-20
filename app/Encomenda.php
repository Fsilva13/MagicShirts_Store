<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{

	protected $fillable = ['id','estado','cliente_id','data',
	'preco_total','notas','nif','endereco','tipo_pagamento','ref_pagamento'
    ];

    public function cliente(){
      return $this->belongsTo('App\Cliente');
    }
    
    public function tshirts(){
        return $this->hasMany('App\Tshirt');
    }
}
