<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Artigo extends Model
{
    use SoftDeletes;

    protected $fillable = ['titulo', 'descricao', 'conteudo', 'data'];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function listaArtigos($paginate){
        //primeira opção
        // $listaArtigos = Artigo::select('id', 'titulo', 'descricao', 'user_id', 'data')->paginate();//Artigo ou self para chamar a propria classe;

        // //preencher nme do lugar do id
        // foreach($listaArtigos as $lista)
        // {
        //     $lista->user_id = User::find($lista->user_id)->name; //Uma Opção de importar o metodo User

        //     //opção do relacionamento do laravel
        //     //$lista->user_id = $lista->user->name;
        //     //unset($lista->user); 
            
        // }

        //segunda opção
        $listaArtigos = DB::table('artigos')
            ->join('users', 'users.id', '=', 'artigos.user_id')
             ->select('artigos.id', 'artigos.titulo', 'artigos.descricao', 'users.name', 'artigos.data')
             ->whereNull('deleted_at')
             ->paginate($paginate);

        return $listaArtigos;
    }

    public static function listaArtigosSite($paginate){
        
        $listaArtigos = DB::table('artigos')
            ->join('users', 'users.id', '=', 'artigos.user_id')
             ->select('artigos.id', 'artigos.titulo', 'artigos.descricao', 'users.name as autor', 'artigos.data')
             ->whereNull('deleted_at')
             ->whereDate('data', '<=', date('Y-m-d'))
             ->orderBy('data', 'desc')
             ->paginate($paginate);

        return $listaArtigos;
    }
}
