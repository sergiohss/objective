<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ContaApiFeatureTest extends TestCase
{
    use DatabaseTransactions;



    /**
     * Teste do método criar da API de conta
     */
    public function testCriarContaPorApi()
    {
        $response = $this->post(route('conta.criar'),[
            'numero_conta' => '555',
            "saldo" => 800
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                    'numero_conta',
                    'saldo',
            ]);

    }

    /**
     * Teste do método buscar conta da API de conta
     */
    public function testVisualizarContaPorNumeroApi()
    {
        $response = $this->get(route('conta.visualizar',['numero_conta' => 999]));

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                    'numero_conta',
                    'saldo',
            ]);

    }

}
