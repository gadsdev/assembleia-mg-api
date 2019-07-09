<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Deputado;

class ReembolsoIndenisacao extends Model
{
    protected $fillable = [
        'id',
        'mes',
        'total_reembolsado'
    ];

}
