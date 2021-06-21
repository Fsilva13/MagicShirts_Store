<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preco extends Model
{
    public $timestamps = false;

	protected $fillable = [
		'id','preco_un_catalogo','preco_un_proprio','preco_un_catalogo_desconto','preco_un_proprio_desconto', 'quantidade_desconto',
	 ];
}
