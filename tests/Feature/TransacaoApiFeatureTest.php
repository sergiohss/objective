<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TransacaoApiFeatureTest extends TestCase
{
    use DatabaseTransactions;



    /**
     * Teste do método realizar transação da API de transação
     */
    public function testCriarTransacaoPorApi()
    {
        $response = $this->post(route('transacao.pagamento'),[
            'numero_conta' => '555',
            "valor" => 100,
            "forma_pagamento" => 'D'
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                    'numero_conta',
                    'saldo',
            ]);

    }


}
