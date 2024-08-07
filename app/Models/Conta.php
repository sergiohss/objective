<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conta extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * CONSTANTES
     */
    const TABELA    = 'contas';

    const ID        = 'id';
    const NUMERO    = 'numero_conta';
    const SALDO     = 'saldo';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';


    protected $fillable = [
        self::NUMERO,
        self::SALDO,
    ];

    protected $table = self::TABELA;
    protected $primaryKey = self::ID;
    public $timestamps = true;

}
