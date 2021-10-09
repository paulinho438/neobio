<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pedidos';
    protected $fillable = [
        'codigo_pedido',
        'codigo_cliente',
        'dateCreate',
        'status',
        'codigo_pedido_integracao',
        'numero_pedido'
    ];
}
