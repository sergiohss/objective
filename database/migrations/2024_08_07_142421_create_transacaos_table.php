<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Transacao;
use App\Models\Conta;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Transacao::TABELA, function (Blueprint $table) {
            $table->id();
            $table->bigInteger(Transacao::NUMERO_CONTA)->unsigned();
            $table->float(Transacao::VALOR);
            $table->float(Transacao::VALOR_TAXA);
            $table->float(Transacao::VALOR_TOTAL);
            $table->enum(Transacao::FORMA_PAGAMENTO,['P','C','D']); // P => Pix / C => Cartão de Crédito / D => Cartão de Débito
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Transacao::TABELA);
    }
};
