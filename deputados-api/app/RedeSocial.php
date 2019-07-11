<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Deputado;

class RedeSocial extends Model
{
    protected $fillable = [
		'id', 'nome', 'url', 'deputado_id'
    ];

    public function deputado() {
        return $this->belongsTo(Deputado::class, 'deputado_id');
    }
}
