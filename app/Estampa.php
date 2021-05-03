<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estampa extends Model
{
	public function categoria(){
		return $this->belongsTo('App\Categoria');
	}
}
