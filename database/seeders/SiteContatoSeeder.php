<?php

namespace Database\Seeders;

use App\Models\SiteContato;
use Database\Factories\SiteContatoFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        //$contato = new SiteContato();
        //$contato->nome = 'Andre';
        //$contato->telefone = '11983233232';
        //$contato->email = 'andre@gmail.com';
        //$contato->motivo_contato = '2';
        //$contato->mensagem = 'Seja bem-vindo ao sistema Super Gestão';
        //$contato->save();

        SiteContato::factory(count:100)->create();
    }
}
