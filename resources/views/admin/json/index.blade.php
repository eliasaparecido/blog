@extends('layouts.app')

@section('content')
    <json titulo="Lista de Usuários"
    v-bind:titulotabela="[
           '#', 'Nome', 'E-mail', 'Data'
           ]"
           criar="#criar"
           detalhe="detalhe" editar="editar" deletar="deletar" modal="sim"> 
        </json>
@endsection
