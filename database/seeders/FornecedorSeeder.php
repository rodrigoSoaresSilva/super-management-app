<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use \App\Models\Fornecedor;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // instanciando objeto
        $fornecedor = new Fornecedor();
        $fornecedor->nome = 'Fornecedor 1';
        $fornecedor->site = 'fornecedor1.com.br';
        $fornecedor->email = 'contato@fornecedor1.com.br';
        $fornecedor->uf = 'CE';
        $fornecedor->save();

        // método create respeitando o atributo $fillable da classe
        Fornecedor::create([
            'nome' => 'Fornecedor 2',
            'site' => 'fornecedor2.com.br',
            'email' => 'contato@fornecedor2.com.br',
            'uf' => 'RS',
        ]);

        // insert
        DB::table('fornecedores')->insert([
            'nome' => 'Fornecedor 3',
            'site' => 'fornecedor3.com.br',
            'email' => 'contato@fornecedor3.com.br',
            'uf' => 'SP',
        ]);
    }
}
