<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use App\Models\Item;
use App\Models\Produto;
use App\Models\ProdutoDetalhe;
use App\Models\Unidade;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
   
    public function index(Request $request)
    {
        $produtos = Item::with(['produtoDetalhe', 'fornecedor'])->paginate(10);

        return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all()]);
    }

    public function create()
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();

        return view('app.produto.create', ['unidades' => $unidades, 'fornecedores'=> $fornecedores]);
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:40',
            'descrição' => 'required|min:3|max:2000',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id',
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no mínimo 40 caracteres',

            'descrição.min' => 'O campo descrição deve ter no mínimo 3 caracteres',
            'descrição.max' => 'O campo descrição deve ter no mínimo 2000 caracteres',
            'peso.integer' => 'O campo peso deve ser um número inteiro',
            'fornecedor_id.exists' => 'O forneceodor informado não existe'
        ];
        $request->validate($regras, $feedback);

        Item::create($request->all());
        return redirect()->route('produto.index');
    }

    public function show(Item $produto)
    {
        $unidades = Unidade::all();
        return view('app.produto.show', ['produto' => $produto, 'unidades' => $unidades]);
    }
  
    public function edit(Item $produto)
    {
        $unidades = Unidade::all();
        $fornecedores = Fornecedor::all();

        return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades, 'fornecedores'=> $fornecedores]);
       //return view('app.produto.create', ['produto' => $produto, 'unidades' => $unidades]);
    }

    public function update(Request $request, Item $produto)
    {   
        $regras = [
            'nome' => 'required|min:3|max:40',
            'descrição' => 'required|min:3|max:2000',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id',
        ];

        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
            'nome.max' => 'O campo nome deve ter no mínimo 40 caracteres',

            'descrição.min' => 'O campo descrição deve ter no mínimo 3 caracteres',
            'descrição.max' => 'O campo descrição deve ter no mínimo 2000 caracteres',
            'peso.integer' => 'O campo peso deve ser um número inteiro',
            'fornecedor_id.exists' => 'O forneceodor informado não existe'
        ];
        $request->validate($regras, $feedback);

        $produto->update($request->all());
        return redirect()->route('produto.show',['produto' => $produto]);
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produto.index');
    }
}
