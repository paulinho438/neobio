<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'produtos';
    protected $fillable = [
        'altura',
        'bloqueado',
        'cnpj_fabricante',
        'codigo',
        'codigo_familia',
        'codigo_produto',
        'codigo_produto_integracao',
        'cupom_fiscal',
        'descr_detalhada',
        'descricao',
        'dias_crossdocking',
        'dias_garantia',
        'ean',
        'estoque_minimo',
        'id_cest',
        'id_preco_tabelado',
        'inativo',
        'indicador_escala',
        'largura',
        'marca',
        'market_place',
        'ncm',
        'obs_internas',
        'origem_mercadoria',
        'peso_bruto',
        'peso_liq',
        'profundidade',
        'quantidade_estoque',
        'tipoItem',
        'unidade',
        'valor_unitario',
        'url_imagem'
    ];
}
