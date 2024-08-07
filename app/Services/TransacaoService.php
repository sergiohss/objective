<?php

namespace App\Services;


use App\Exceptions\TransactionException;
use App\Models\Conta;
use App\Models\Transacao;
use App\Repositories\ContaRespository;
use App\Repositories\TransacaoRespository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


/**
 * Class TransacaoService
 * @package App\Services
 */
class TransacaoService
{
    private $percentualFormaPagamento = [
        'P'  =>  0,
        'C'  =>  5,
        'D'  =>  3
    ];

    /**
     * @var TransacaoRespository
     */
    protected $transacaoRespository;

    /**
     * @var ContaService
     */
    protected $contaService;

    /**
     * @var ContaRespository
     */
    private $contaRespository;
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    private $conta;

    /**
     * @var float
     */
    private $valor;

    /**
     * @var float
     */
    private $forma_pagamento;

    /**
     * @var void
     */
    private $valor_taxa;

    /**
     * @var float|void
     */
    private $valor_total;

    /**
     * @param TransacaoRespository $transacaoRespository
     * @param ContaService $contaService
     * @param ContaRespository $contaRespository
     */
    public function __construct(
        TransacaoRespository $transacaoRespository,
        ContaService $contaService,
        ContaRespository $contaRespository
    )
    {
        $this->transacaoRespository = $transacaoRespository;
        $this->contaService = $contaService;
        $this->contaRespository = $contaRespository;
    }


    /**
     * @param array $requestData
     * @return bool
     * @throws \App\Exceptions\NotFoundException
     * @throws \Exception
     */
    public function realizarPagamento(array $requestData)
    {
        $this->conta = $this->contaRespository->obterPorNumeroConta(data_get($requestData, Conta::NUMERO));
        $this->valor = (float) data_get($requestData, Transacao::VALOR);
        $this->forma_pagamento = data_get($requestData, Transacao::FORMA_PAGAMENTO);


        $this->validaValorPositivo()
            ->calculaValorTaxa()
            ->calculoValorPagamento()
            ->validaSaldoSuficiente();

        try{
            DB::beginTransaction();

            $this->transacaoRespository->criar([
                'numero_conta' => data_get($requestData, Conta::NUMERO),
                'valor' => $this->valor,
                'valor_taxa' => $this->valor_taxa,
                'valor_total' => $this->valor_total,
                'forma_pagamento' => $this->forma_pagamento
            ]);


            $this->contaService->salvar([
                "saldo" => $this->conta - $this->valor_total
            ], data_get($requestData, Conta::NUMERO));

            DB::commit();

            return $this->contaService->visualizar($requestData);

        }catch (\Exception $e){
            DB::rollBack();
            throw new \Exception('Erro ao completar a transação.');
        }
    }

    /**
     * @return $this
     * @throws \Exception
     */
    private function validaValorPositivo()
    {
        if($this->valor <= 0){
            throw new \Exception('O valor do pagamento precisa ser maior que zero');
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function calculoValorPagamento()
    {
        $this->valor_total = $this->valor + $this->valor_taxa;

        return $this;
    }

    /**
     * @return $this
     */
    private function calculaValorTaxa()
    {
        $percentualTaxa = $this->percentualFormaPagamento[$this->forma_pagamento];

        $this->valor_taxa = $this->valor * $percentualTaxa / 100;

        return $this;
    }

    /**
     * @return $this
     * @throws \Exception
     */
    private function validaSaldoSuficiente()
    {
        if($this->valor_total > $this->conta->saldo){
            throw new \Exception('A conta não possui saldo suficiente para realizar o pagamento');
        }

        return $this;
    }
}
