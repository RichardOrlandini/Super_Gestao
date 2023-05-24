<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descrição',
        'peso',
        'unidade_id',
    ];


    public function produtoDetalhe(){
        return $this->hasOne('App\produtoDetalhe');
        /*
        this -> objeto em questão no caso o PRODUTO.
        1- Um Produto tem um produto_detalhe
        2- Em produto_detalhes temos uma (fk) de produto_d pois é a tabela mais fraca
        */ 
    }
}
