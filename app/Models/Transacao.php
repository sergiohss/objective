<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transacao extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * CONSTANTES
     */
    const TABELA            = 'transacoes';

    const ID                = 'id';
    const NUMERO_CONTA      = 'numero_conta';
    const VALOR             = 'valor';
    const VALOR_TAXA        = 'valor_taxa';
    const VALOR_TOTAL       = 'valor_total';
    const FORMA_PAGAMENTO   = 'forma_pagamento';
    const CREATED_AT        = 'created_at';
    const UPDATED_AT        = 'updated_at';
    const DELETED_AT        = 'deleted_at';


    protected $fillable = [
        self::NUMERO_CONTA,
        self::VALOR,
        self::VALOR_TAXA,
        self::VALOR_TOTAL,
        self::FORMA_PAGAMENTO,
    ];

    protected $table = self::TABELA;
    protected $primaryKey = self::ID;
    public $timestamps = true;

}
