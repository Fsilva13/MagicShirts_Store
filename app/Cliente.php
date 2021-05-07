<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function encomendas{
        return $this->belongsTo('App\Encomenda');
    }

    public function users{
        return $this->hasOne('App\User', 'id');
    }
}
