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
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'numero_conta',
                    'saldo',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ]
            ]);

    }

//    /**
//     * Teste do método buscar conta da API de conta
//     */
//    public function testGetAccountByIdApi()
//    {
//        $response = $this->get(route('api.accounts.show',1));
//
//        $response
//            ->assertStatus(200)
//            ->assertJsonStructure([
//                'data' => [
//                    'id',
//                    'fullname',
//                    'email',
//                    'created_at',
//                    'updated_at',
//                    'deleted_at',
//                    'wallet',
//                    'shops'
//                ]
//            ]);
//
//    }

}
