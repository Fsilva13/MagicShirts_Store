<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

	/*$sql = "SELECT MAX(ID) FROM CLIENTES";
	$dbh->query($sql);
	

	private $createTime = time();
	private $update_time = time();
*/
	protected $fillable = [
       'ID','NIF', 'endereco', 'tipo_pagamento', 'ref_pagamento', $createTime, $update_time,  //ID não é auto increment na BD
    ];

    public function encomendas(){
        return $this->haMany('App\Encomenda');
    }

    public function user(){
        return $this->belongsTo('App\User', 'id');
    }
    public function estampas(){
		return $this->hasMany('App\Estampa');
	}
}
