<?php

namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Models\Conta;
use Illuminate\Database\Eloquent\Model;

class ContaRespository
{
    /**
     * @var Conta
     */
    private $conta;

    /**
     * @param Conta $conta
     */
    public function __construct(Conta $conta)
    {
        $this->conta = $conta;
    }


    /**
     * @param int $numero_conta
     * @return Model
     * @throws NotFoundException
     */
    public function obterPorNumeroConta(int $numero_conta):Model
    {
        $conta = $this->conta->where(Conta::NUMERO, $numero_conta)->first();

        if(!$this->conta instanceof Conta){
            throw new NotFoundException('Conta não encontrada');
        }

        return $conta;
    }

    /**
     * @param array $data
     * @param int|null $numero_conta
     * @return Model
     * @throws NotFoundException
     */
    public function salvar(array $data, int $numero_conta = null):Model
    {
        if($numero_conta){
            $this->conta = $this->obterPorNumeroConta($numero_conta);
        }
        $this->conta->fill($data)->save();
        return $this->conta;
    }
}
