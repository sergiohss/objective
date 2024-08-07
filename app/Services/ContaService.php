<?php

namespace App\Services;

use App\Models\Conta;
use App\Repositories\ContaRespository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContaService
 * @package App\Services
 */
class ContaService
{
    /**
     * @var ContaRespository
     */
    protected $contaRespository;

    /**
     * ContaService constructor.
     * @param ContaRespository $contaRespository
     */
    public function __construct(
        ContaRespository $contaRespository,
    )
    {
        $this->contaRespository = $contaRespository;
    }


    /**
     * @param array $requestData
     * @param int|null $id
     * @return Model
     */
    public function salvar(array $requestData, int $numero_conta = null)
    {
        $conta = $this->contaRespository->salvar($requestData, $numero_conta);

        return $this->transformarRetornoConta($this->contaRespository->obterPorNumeroConta(data_get($conta, Conta::NUMERO))) ;
    }

    /**
     * @param array $requestData
     * @return Model
     * @throws \App\Exceptions\NotFoundException
     */
    public function visualizar(array $requestData)
    {
        return $this->transformarRetornoConta($this->contaRespository->obterPorNumeroConta(data_get($requestData, Conta::NUMERO))) ;
    }


    public function transformarRetornoConta(Conta $conta)
    {
        return $conta->only([Conta::NUMERO, Conta::SALDO]);
    }

}
