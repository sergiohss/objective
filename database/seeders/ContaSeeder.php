<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Conta;

class ContaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if(!Conta::where(Conta::NUMERO, 999)->first()){
            Conta::create([
                Conta::NUMERO => 999,
                Conta::SALDO => 500,
            ]);
        }
    }
}
