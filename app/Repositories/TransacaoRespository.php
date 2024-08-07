<?php

namespace App\Repositories;


use App\Models\Transacao;
use Illuminate\Database\Eloquent\Model;


class TransacaoRespository
{
    /**
     * @var Transacao
     */
    private $transacao;

    /**
     * @param Transacao $transacao
     */
    public function __construct(Transacao $transacao)
    {
        $this->transacao = $transacao;
    }

    /**
     * @param array $data
     * @return Model
     */
    public function criar(array $data):Model
    {
        if(!$this->transacao->fill($data)->save()){
            throw new \Exception('Ocoreu um erro ao salvar o pagamento');
        }

        return $this->transacao;
    }
}
