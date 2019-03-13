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
    <painel titulo="Lista de Produtos">
       <tabela-lista 
        v-bind:titulos="[
           '#', 'Nome', 'E-mail'
           ]"
           v-bind:itens="{{json_encode($listaModelo)}}"
            ordem="desc" orderCol="1"
            criar="#criar" detalhe="/admin/produtos/" editar="/admin/produtos/" deletar="/admin/produtos/" token="{{csrf_token()}}"
            modal="sim"
        ></tabela-lista>
        <div style="align: center">
            {{$listaModelo}}
        </div>
    </painel>
</pagina>

<modal nome="adicionar" titulo="Adicionar">
    <formulario id="formAdicionar" css="" action="{{route('produtos.store')}}" method="post" enctype="" token="{{csrf_token()}}">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="{{old('nome')}}">
        </div>
        <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="valor" class="form-control" id="valor" name="valor" placeholder="Valor" value="{{old('valor')}}">
        </div>
    </formulario>
    <span slot="botoes">
        <button form="formAdicionar" class="btn btn-primary">Adicionar</button>
    </span>
    
</modal>
<modal nome="editar" titulo="Editar">
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
    
</modal>
<modal nome="detalhe" v-bind:titulo="$store.state.item.nome">
    <p>Valor: @{{$store.state.item.valor}}</p>
</modal>
@endsection
