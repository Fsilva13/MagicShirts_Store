<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
<<<<<<< Updated upstream
		protected $fillable = [
        'estado', 'notas', 'nif','endereco','metpag',
    ];

=======
	protected $fillable = [
        'estado', 'notas', 'nif','endereco','metpag',
    ];


>>>>>>> Stashed changes
    public function clientes(){
      return $this->belongsTo('App\Cliente');
    }
    
    public function tshirts(){
        return $this->hasMany('App\Tshirt');
    }
}
