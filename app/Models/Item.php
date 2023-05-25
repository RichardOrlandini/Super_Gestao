<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'descrição',
        'peso',
        'unidade_id',
        'fornecedor_id'
    ];

    public function produtoDetalhe(){
        return $this->hasOne('App\Models\ItemDetalhe', 'produto_id', 'id');
    }

    public function fornecedor(){
        return $this->belongsTo('App\Models\Fornecedor');
    }

    
    public function pedidos(){
        return $this->belongsToMany('App\Models\Pedido', 'pedidos_produtos', 'produto_id', 'pedido_id');
    }

    //3º Nome da fk da tabela mapeada pelo model da tabela de relacionamento
    //4º Nome da fk da tabela mapeada pelo model utilizado no relacionamento que estamos implementando
}
