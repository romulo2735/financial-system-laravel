<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function Perfil(){
        return view('site.perfil.perfil');
    }

    public function PerfilAtualizar(Request $request){
        $dados = $request->all();

        //verificando senha, caso o User tenha modifcado.
        if ($dados['password'] != null){
            $dados['password'] = bcrypt($dados['password']);
        }
        else{
            unset($dados['password']);
        }

        //atualizar apenas usuario logado.
        $att = auth()->user()->update();

        if ($att){
            return redirect()->route('perfil')->with('success', 'Sucesso ao Atualizar o Perfil');
        }
        return redirect()->back()->with('error', 'Falha ao Atualizar o Perfil');
    }
}
