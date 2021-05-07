<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cor extends Model
{
	protected $table = "cores";
	protected $primaryKey = "codigo";
	protected $keyType = 'string';

   public function tshirts(){
		return $this->hasMany('App\Tshirt');
	}
}
