<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //criando a coluna produtos que vai receber a fk de fornecedores

        Schema::table('produtos', function(Blueprint $table){

            //inserindo um registro de fornecedor para estabelecer o relacionamento, isso não e necessario se a tabela estiver vazia de produtos*

            $fornecedor_id =  DB::table('fornecedores')->insertGetId([
                'nome' => 'Fornecedor padrão SG',
                'site' => 'fornecedor.com.br',
                'uf' => 'SP',
                'email' => 'fornecedor'
            ]);

            $table->unsignedBigInteger('fornecedor_id')->default($fornecedor_id)->after('id');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedores');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos', function(Blueprint $table){
        $table->dropForeign('produtos_fornecedor_id_foreign');
        $table->dropColumn('fornecedor_id');
        });
    }
};
