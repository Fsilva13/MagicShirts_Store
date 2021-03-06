<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estampa extends Model
{
	use SoftDeletes;

	protected $fillable = [
        'id','cliente_id','nome', 'descricao', 'imagem_url'
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
