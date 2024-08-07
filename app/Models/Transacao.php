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
    const TABELA    = 'transacoes';

    const ID            = 'id';
    const CONTA_ID      = 'conta_id';
    const VALOR         = 'valor';
    const VALOR_TAXA    = 'valor_taxa';
    const VALOR_TOTAL   = 'valor_total';
    const CREATED_AT    = 'created_at';
    const UPDATED_AT    = 'updated_at';
    const DELETED_AT    = 'deleted_at';


    protected $fillable = [
        self::CONTA_ID,
        self::VALOR,
        self::VALOR_TAXA,
        self::VALOR_TOTAL,
    ];

    protected $table = self::TABELA;
    protected $primaryKey = self::ID;
    public $timestamps = true;

    public static $rules = [
        self::CONTA_ID => 'required',
        self::VALOR => 'required',
    ];

    public static $messages = [
        self::CONTA_ID.'.required' => 'O campo ID da Conta é obrigatório',
        self::VALOR.'.required' => 'O campo Valor da Conta é obrigatório',
    ];
}
