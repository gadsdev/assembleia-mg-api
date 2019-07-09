<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ReembolsoIndenisacao;

class Deputado extends Model
{  
    protected $fillable = [
		'name', 'id'
    ];

    public function reembolso() {
      return $this->hasMany(ReembolsoIndenisacao::class, 'deputado_id');
    }

}
