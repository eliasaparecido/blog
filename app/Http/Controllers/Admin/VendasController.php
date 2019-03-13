<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Vendas;
use App\VendaItems;

class VendasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaMigalhas = json_encode([
            ["titulo"=>"Admin","url"=>route('admin')],
            ["titulo"=>"Lista de Vendas","url"=>""],
        ]);

        $listaModelo = Vendas::select('id', 'data', 'valortotal')->paginate();

        return view('admin.vendas.index', compact('listaMigalhas', 'listaModelo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listaMigalhas = json_encode([
            ["titulo"=>"Admin","url"=>route('admin')],
            ["titulo"=>"Lista de Vendas","url"=>route('vendas.index')],
            ["titulo"=>"Nova Venda","url"=>""],
        ]);
        return view('admin.vendas.venda', compact('listaMigalhas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {            
       
        try{
            \DB::beginTransaction();
            $venda = new Vendas();

            $venda->data = $request->data;
            $venda->valortotal = $request->valortotal;

            $venda->save();
            
            foreach( $request->list as  $l)
            {
                $vendaItens = new VendaItems();

                $vendaItens->venda_id = $venda->id;
                $vendaItens->produto_id = $l['produto_id'];
                $vendaItens->valorun = $l['valor'];
                $vendaItens->valortotal = $l['valor'];
                $vendaItens->save();

            }
            \DB::commit();
             return response()->json([$venda], 200);
        }
        catch(\Exception $e) {
            \DB::rollback();
            return response()->json([$e], 404);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
