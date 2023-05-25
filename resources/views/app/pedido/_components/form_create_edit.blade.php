 
 @if(isset($pedido->id))
        <form method="post" action="{{route('cliente.update', ['cliente' => $cliente->id])}}" >
        @csrf
        @method('PUT')
@else
        <form method="post" action="{{route('pedido.store')}}" >
        @csrf
@endif
            <select name="cliente_id">
                <option> -- Selecione um Cliente -- </option>

                @foreach ($clientes as $cliente )
                        <option value="{{ $cliente->id}}" {{($pedido->cliente_id ?? old('cliente_id')) == $cliente->id ? 'selected' : ''}}> {{$cliente->nome}} </option>
                @endforeach
            </select>
                    {{ $errors->has('fornecedor_id') ? $errors->first('fornecedor_id') : ''}}
                
            <button type="submit" class="borda-preta">Cadastrar</button>
        </form>