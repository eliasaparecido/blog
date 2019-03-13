<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artigo;
use App\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaMigalhas = json_encode([
            ["titulo"=>"Admin","url"=>route('admin')],
        ]);
        $autores=0;
        $usuarios=0;
        $admin=0;

        $artigos = Artigo::count();
        $todosusuarios = User::get();
        foreach($todosusuarios as $user)
        {
            if($user->autor =="S")
            {
                $autores++;
            }
            if($user->admin =="S")
            {
                $admin++;
            }
            $usuarios++;
        }

        return view('admin', compact('listaMigalhas', 'artigos', 'usuarios', 'autores', 'admin'));
    }
}
