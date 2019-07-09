<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Deputado;

class ReembolsoIndenisacao extends Model
{
    protected $fillable = [
		'mes', 'total_reembolsado', 'deputado_id'
    ];

    public function deputado() {
        return $this->belongsTo(Deputado::class, 'deputado_id');
    }
}
