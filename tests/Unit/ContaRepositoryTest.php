<?php

namespace Tests\Unit;

use App\Models\Conta;
use App\Repositories\ContaRespository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ContaRepositoryTest extends TestCase
{
    use DatabaseTransactions;



    /**
     * Teste do método salvar conta do repositório de conta
     */
    public function testSalvarConta()
    {
        $service = app(ContaRespository::class);

        $conta = $service->salvar([
            'numero_conta' => '333',
            "saldo" => 200
        ]);

        $this->assertInstanceOf(Conta::class, $conta);
    }

    /**
     * Teste do método buscar por numero da conta do repositório de conta
     */
    public function testObterPorNumeroConta()
    {
        $service = app(ContaRespository::class);

        $conta = $service->obterPorNumeroConta(999);

        $this->assertInstanceOf(Conta::class, $conta);
    }

    /**
     * Teste do método atualizar conta do repositório de conta
     */
    public function testAtualizarConta()
    {
        $service = app(ContaRespository::class);

        $conta = $service->salvar([
            "saldo" => 300
        ], 999);

        $this->assertInstanceOf(Conta::class, $conta);
    }


}
