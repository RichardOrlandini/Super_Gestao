<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\DB;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //instânciando um obj
        $fornecedor = new Fornecedor();
        $fornecedor->nome = 'Fornecedor 100';
        $fornecedor->site = 'fornecedor100';
        $fornecedor->uf = 'CE';
        $fornecedor->email = 'fornecedor@for.com.br';
        $fornecedor->save();

        
        Fornecedor::create([
            'nome' => 'Fornecedor 200',
            'site' => 'Fornecedor 200',
            'uf' => 'SP',
            'email' => 'fornecedor@200.com.br'
        ]);

        //insert (Não utilizar esse formato)
        DB::table('fornecedores')->insert([
            'nome' => 'Fornecedor 300',
            'site' => 'Fornecedor 300',
            'uf' => 'SC',
            'email' => 'fornecedor@300.com.br'
        ]);

    }
}
