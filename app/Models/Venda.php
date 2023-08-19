<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nome_produto',
        'valor',
        'forma_pagamento',
        'num_parcelas',
        'valor_parcela',
        'data_pagamento'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
