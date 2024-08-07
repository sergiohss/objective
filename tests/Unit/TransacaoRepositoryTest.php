<?php

namespace Tests\Unit;


use App\Models\Transacao;
use App\Repositories\TransacaoRespository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TransacaoRepositoryTest extends TestCase
{
    use DatabaseTransactions;



    /**
     * Teste do método criar transação do repositório de transação
     */
    public function testCriarTransacao()
    {
        $service = app(TransacaoRespository::class);

        $conta = $service->criar([
            'numero_conta' => 999,
            'valor' => 100,
            'valor_taxa' => 5,
            'valor_total' => 105,
            'forma_pagamento' => 'C'
        ]);

        $this->assertInstanceOf(Transacao::class, $conta);
    }




}
