@extends('layouts.app')

@section('content')
<pagina tamanho="12">
    <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>
    @if ($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif
    <painel titulo="Nova Venda">
        
            
            {{--  <formulario id="formAdicionar" css="" action="{{route('vendas.store')}}" method="post" enctype="" token="{{csrf_token()}}">  --}}
                    {{--  <div class="form-group">
                        <label for="nome">Data:</label>
                        <input type="date" class="form-control" id="data" name="data" placeholder="data" value="{{old('data')}}">
                    </div>
                    <div class="form-group">
                        <label for="valortotal">Valor Total:</label>
                        <input type="text" class="form-control" id="valortotal" name="valortotal" placeholder="Valortotal" value="{{old('valortotal')}}">
                    </div>  --}}
                
            
            <div class="col-md-12">
                <task-list action="{{route('vendas.salvar')}}" token="{{csrf_token()}}"></task-list>
            </div>
        {{--  </formulario>  --}}
        </div>
    </painel>
</pagina>
    
@endsection