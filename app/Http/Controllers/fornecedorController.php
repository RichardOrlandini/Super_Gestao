<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class fornecedorController extends Controller
{
    public function index(){
        $fornecedores = [
            0 => [
                'nome' => 'Fornecedor 1',
                'status' => 'N',
                'cnpj' => '0',
                'ddd' => '', //São Paulo (SP)
                'telefone' => '0000-0000'
            ],
            1 => [
                'nome' => 'Fornecedor 2',
                'status' => 'S',
                'cnpj' => null,
                'ddd' => '85', //Fortaleza (CE)
                'telefone' => '0000-0000'
            ],
            2 => [
                'nome' => 'Fornecedor 2',
                'status' => 'S',
                'cnpj' => null,
                'ddd' => '32', //Juiz de fora (MG)
                'telefone' => '0000-0000'
            ]
        ];

        return view('app.fornecedor.index', compact('fornecedores'));
    }

    public function listar(Request $request){

        $fornecedores = Fornecedor::with(['produtos'])->where('nome', 'like', '%' .$request->input('nome'). '%' )
            ->where('site', 'like', '%' .$request->input('site'). '%' )
            ->where('uf', 'like', '%' .$request->input('uf'). '%' )
            ->where('email', 'like', '%' .$request->input('email'). '%' )
            ->paginate(5);
        
        return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
    }

    public function adicionar(Request $request){
        $msg = '';

        //Criação
        if ($request->input('_token') != '' && $request->input('id') == ''){
            //VALIDANDO OS DADOS

            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email' => 'email'
            ];

            $feedback = [
                'required' => 'O campo :attribute deve ser preenchido.',
                'nome.min' =>'O campo nome deve ter no mínimo 3 caracteres',
                'nome.max' =>'O campo nome deve ter no maxímo 40 caracteres',
                'uf.min' =>'O campo uf deve ter no mínimo 2 caracteres',
                'uf.max' =>'O campo uf deve ter no maxímo 2 caracteres',
                'email.email' => 'O campo email não foi preenchido corretamente.'
            ];

            $request->validate($regras, $feedback);

            $fornecedor = new Fornecedor();
            $fornecedor->create($request->all());

            $msg = 'Cadastro realizado com sucesso';
        }

        //Edição
        if ($request->input('_token') != '' && $request->input('id') != ''){
            $fornecedor = Fornecedor::find($request->input('id'));
            $update =  $fornecedor->update($request->all());
            $update ? $msg =  "Atualização realizado com sucesso." : $msg = "Erro ao tentar atualizar o registro.";
            
            return redirect()->route('app.fornecedor.editar', ['id' => $request->input('id'), 'msg' => $msg]);

        }
        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = ''){
        $fornecedor = Fornecedor::find($id);
        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
    }

    
    public function delete($id){
        Fornecedor::find($id)->delete();
        return redirect()->route('app.fornecedor');
    }
}
