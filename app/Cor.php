<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cor extends Model
{
   public function tshirts(){
		return $this->hasMany('App\Tshirt');
	}
}
