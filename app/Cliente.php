<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function estampas(){
		return $this->hasMany('App\Estampa');
	}
}
