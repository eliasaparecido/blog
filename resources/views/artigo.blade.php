@extends('layouts.app')

@section('content')
<pagina tamanho="12">
    <painel>
        <h2>{{$artigo->titulo}}</h2><hr>
        <h4>{{$artigo->descricao}}</h4>
        <p>
            {!!$artigo->conteudo!!}}
        </p><hr>
        <p><small>Por: {{$artigo->user->name}} - {{date('d/m/Y', strtotime($artigo->data))}}</small></p>
    </painel>
</pagina>
@endsection



