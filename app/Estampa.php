<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estampa extends Model
{
	protected $fillable = [
        'id','nome', 'descricao', 'imagem_url'
    ];

	public function categoria(){
		return $this->belongsTo('App\Categoria');
	}

	public function cliente(){
		return $this->belongsTo('App\Cliente');
	}
	public function tshirts(){
		return $this->hasMany('App\Tshirt');
	}
	
}
