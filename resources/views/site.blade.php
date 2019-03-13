@extends('layouts.app')

@section('content')
<pagina tamanho="12">
    <painel titulo="Artigos">
        <div class="row">
            <form class="navbar-form navbar-right" action="{{route('site')}}" method="get">
                <div class="form-group">
                    <input type="text" class="form-control" name="busca" placeholder="Buscar" value="{{isset($busca)?$busca:""}}">
                </div>
            <button type="submit" class="btn btn-default">Buscar</button>
            </form>
        </div>

        <div class="row">
            @foreach ($lista as $l)
            <artigocard
                titulo="{{str_limit($l->titulo, 20, '...')}}"
                descricao="{{str_limit($l->descricao, 30, '...')}}"
                link="{{route('artigo', [$l->id, str_slug($l->titulo)])}}"
                imagem="https://via.placeholder.com/350x350"
                data="{{$l->data}}"
                autor="{{$l->autor}}"
                sm="6"
                md="4">
            </artigocard>
            @endforeach
        </div>
        <div style="align: center">
            {{$lista}}
        </div>
    </painel>
</pagina>
@endsection



