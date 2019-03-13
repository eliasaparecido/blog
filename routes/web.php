<?php

use App\Artigo;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    if(isset($request->busca) && $request->busca != ""){
        $lista = Artigo::orWhere('titulo', 'like', '%'.$request->busca.'%')
            ->orWhere('descricao', 'like','%'.$request->busca.'%')
            ->paginate(3);
        $busca = $request->busca;
    } else {
        $lista = Artigo::listaArtigosSite(3);
        $busca = "";
    }

    return view('site', compact('lista','busca'));
    
})->name('site');

Route::get('/artigo/{id}/{titulo?}', function ($id) {
    $artigo = Artigo::find($id);
    if($artigo){
        return view('artigo', compact('artigo'));
    }
    return redirect()->route('site');
})->name('artigo');

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('can:autor');

Route::middleware(['auth'])->prefix('admin')->namespace('Admin')->group(function(){
    Route::resource('artigos', 'ArtigosController')->middleware('can:autor');
    Route::resource('usuarios', 'UsuariosController')->middleware('can:eAdmin');
    Route::resource('autores', 'AutoresController')->middleware('can:eAdmin');
    Route::resource('adm', 'AdminController')->middleware('can:eAdmin');
    Route::resource('produtos', 'ProdutoController')->middleware('can:eAdmin');
    Route::resource('vendas', 'VendasController')->middleware('can:eAdmin');
    Route::post('vendas/salvar',['as' => 'vendas.salvar', 'uses' => 'VendasController@store']);
    Route::resource('vendas/vendas-itens', 'VendaItemsController')->middleware('can:eAdmin');
});