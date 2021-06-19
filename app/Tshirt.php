<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
	public $timestamps = false;

	protected $fillable = [
		'id', 'encomenda_id', 'quantidade', 'estampa_id', 'cor_codigo', 'tamanho', 'preco_un', 'subtotal',
	];

	public function encomenda()
	{
		return $this->hasMany('App\Encomenda');
	}
	public function estampa()
	{
		return $this->belongsTo('App\Estampa');
	}
	public function cor()
	{
		return $this->belongsTo('App\Cor');
	}
}
