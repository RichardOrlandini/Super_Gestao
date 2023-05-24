@extends('app.layouts.basico')

@section('titulo', 'Produtos')

@section('conteudo')

    <div class="titulo-pagina-2">
        <p>Produtos-Editar</p>
    </div>

    <div class="menu">
        <ul>
        <li><a href="{{ route('produto.index')}}" >Voltar</a></li>
        <li><a href="">Consulta</a></li>
        </ul>
    </div>

    
    <div class="informacao-pagina">
    {{ $msg ?? '' }}
        <div style="width: 30%; margin-left: auto; margin-right: auto;">

        <form method="post" action="{{ route('produto.update', ['produto' => $produto->id]) }}" >
            @csrf
            @method('PUT')
            
            <input type="text" name="nome" value="{{ $produto->nome ?? old('nome')}}" placeholder="Nome" class="borda-preta">
            {{ $errors->has('nome') ? $errors->first('nome') : ''}}
            
            <input type="text" name="descrição" value="{{$produto->descriçaõ ?? old('descrição')}}" placeholder="Descrição" class="borda-preta">
                {{ $errors->has('descrição') ? $errors->first('descrição') : ''}}
     
            <input type="text" name="peso" value="{{$produto->peso ?? old('peso')}}" placeholder="Peso" class="borda-preta">
                {{ $errors->has('peso') ? $errors->first('peso') : ''}}

            <select name="unidade_id">
                <option> -- Selecione a Unidade de Medida -- </option>

                @foreach ($unidades as $unidade )
                    <option value="{{ $unidade->id}}" {{$produto->unidade_id ?? old('unidade_id')== $unidade->id ? 'selected' : ''}}> {{$unidade->descrição}} </option>
                @endforeach
            </select>
                {{ $errors->has('unidade_id') ? $errors->first('unidade_id') : ''}}

            <button type="submit" class="borda-preta">Cadastrar</button>
        </form>
        </div>
    </div>

@endsection()
