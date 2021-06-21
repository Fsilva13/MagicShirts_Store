<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cor extends Model
{
	use SoftDeletes;
	public $timestamps = false;

	protected $fillable = [
		'codigo','nome',
	 ];
	
	protected $table = "cores";
	protected $primaryKey = "codigo";
	protected $keyType = 'string';

   public function tshirts(){
		return $this->hasMany('App\Tshirt'); 
	}
}
