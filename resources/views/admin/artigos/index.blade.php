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
    <painel titulo="Lista de Artigos">
       <tabela-lista 
        v-bind:titulos="[
           '#', 'Título', 'Descrição', 'Autor', 'Data'
           ]"
           v-bind:itens="{{json_encode($listaArtigos)}}"
            ordem="desc" orderCol="1"
            criar="#criar" detalhe="/admin/artigos/" editar="/admin/artigos/" deletar="/admin/artigos/" token="{{csrf_token()}}"
            modal="sim"
        ></tabela-lista>
        <div style="align: center">
            {{$listaArtigos}}
        </div>
    </painel>
</pagina>

<modal nome="adicionar" titulo="Adicionar">
    <formulario id="formAdicionar" css="" action="{{route('artigos.store')}}" method="post" enctype="" token="{{csrf_token()}}">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" value="{{old('titulo')}}">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{old('descricao')}}">
        </div>
        <div class="form-group">
            <label for="conteudo">Conteúdo</label>
            <textarea class="form-control" id="conteudo" name="conteudo">{{old('conteudo')}}</textarea>
        </div>

        <div class="form-group">
            <label for="data">Data</label>
            <input type="date" class="form-control" id="data" name="data" value="{{old('data')}}">
        </div>
    </formulario>
    <span slot="botoes">
        <button form="formAdicionar" class="btn btn-primary">Adicionar</button>
    </span>
    
</modal>
<modal nome="editar" titulo="Editar">
    <formulario id="formEditar" v-bind:action="'/admin/artigos/' + $store.state.item.id" method="put" token="{{csrf_token()}}">
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" 
            v-model="$store.state.item.titulo">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" 
            v-model="$store.state.item.descricao">
        </div>
        <div class="form-group">
            <label for="conteudo">Conteúdo</label>
            <textarea class="form-control" id="conteudo" name="conteudo" 
            v-model="$store.state.item.conteudo"></textarea>
        </div>
        <div class="form-group">
            <label for="data">Data</label>
            <input type="date" class="form-control" id="data" name="data" 
            v-model="$store.state.item.data">
        </div>
    </formulario>
    <span slot="botoes">
        <button form="formEditar" class="btn btn-primary">Editar</button>
    </span>
    
</modal>
<modal nome="detalhe" v-bind:titulo="$store.state.item.titulo">
    <p>Descrição: @{{$store.state.item.descricao}}</p>
    <p>Conteúdo: @{{$store.state.item.conteudo}}</p>
</modal>
@endsection
