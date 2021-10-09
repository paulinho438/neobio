<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    public $timestamps = false;

    protected $fillable = [
        'bairro',
        'bloqueado',
        'bloquear_faturamento',
        'cep',
        'cidade',
        'cnae',
        'cnpj_cpf',
        'codigo_cliente_integracao',
        'codigo_cliente_omie',
        'codigo_pais',
        'complemento',
        'contato',
        'contribuinte',
        'email',
        'endereco',
        'endereco_numero',
        'estado',
        'exterior',
        'fax_ddd',
        'fax_numero',
        'homepage',
        'inativo',
        'inscricao_estadual',
        'inscricao_municipal',
        'inscricao_suframa',
        'logradouro',
        'nif',
        'nome_fantasia',
        'obs_detalhadas',
        'observacao',
        'optante_simples_nacional',
        'pessoa_fisica',
        'produtor_rural',
        'razao_social',
        'recomendacao_atraso',
        'tags',
        'telefone1_ddd',
        'telefone1_numero',
        'telefone2_ddd',
        'telefone2_numero',
        'tipo_atividade',
        'valor_limite_credito',
        'password'
    ];

    
    protected $hidden = ['password'];

    
}
