<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendaItems extends Model
{
    protected $fillable = [
        'venda_id', 'produto_id', 'valor_un', 'valor_total'
    ];
    //protected $guarded = [];
}
