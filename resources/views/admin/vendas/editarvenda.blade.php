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
    <painel titulo="Lista de Vendas">
        <formulario id="formEditar" v-bind:action="'/admin/produtos/' + $store.state.item.id" method="put" token="{{csrf_token()}}">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" 
                v-model="$store.state.item.nome">
            </div>
            <div class="form-group">
                <label for="valor">Valor:</label>
                <input type="valor" class="form-control" id="valor" name="valor" placeholder="Valor" 
                v-model="$store.state.item.valor">
            </div>
        </formulario>
        <span slot="botoes">
            <button form="formEditar" class="btn btn-primary">Editar</button>
        </span>
    </painel>
</pagina>

@endsection
