@extends('layouts.app')

@section('content')
<pagina tamanho="10">
    <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>
    <painel titulo="Dashboard">
        <div class="row">
            @can('autor')
            <div class="col-md-4">
                <caixa qtde="{{$artigos}}" titulo="Artigos" url="{{route('artigos.index')}}" cor="orange" icone="icon ion-md-stats"></caixa>
            </div>
            @endcan
            @can('eAdmin')
            <div class="col-md-4">
                    <caixa qtde="{{$usuarios}}" titulo="Usuários" url="{{route('usuarios.index')}}" cor="blue" icone="icon ion-md-contacts"></caixa>
            </div>
            <div class="col-md-4">
                    <caixa qtde="{{$autores}}" titulo="Autores" url="{{route('autores.index')}}" cor="red" icone="icon ion-md-person"></caixa>
            </div>
            <div class="col-md-4">
                    <caixa qtde="{{$admin}}" titulo="Administradores" url="{{route('adm.index')}}" cor="green" icone="icon ion-md-person"></caixa>
            </div>
            @endcan
        </div>
    </painel>
</pagina>

@endsection
