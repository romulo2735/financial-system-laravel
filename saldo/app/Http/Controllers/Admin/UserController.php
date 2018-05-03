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
        
    }
}
