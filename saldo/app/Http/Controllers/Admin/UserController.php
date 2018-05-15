<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileFormRequest;

class UserController extends Controller
{

    public function Perfil(){
            return view('site.perfil.perfil');
    }

    public function PerfilAtualizar(UpdateProfileFormRequest $request){
        //dados do usuario logado.
        $usuario = auth()->user();
        $dados = $request->all();

        //verificando senha, caso o User tenha modifcado.
        if ($dados['password'] != null){
            $dados['password'] = bcrypt($dados['password']);
        }
        else{
            unset($dados['password']);
        }

        //upload da imagem do perfil, verificando se é um arquivo que pode ser incluso.
        $dados['image'] = $usuario->image;
        if($request->hasFile('image') && $request->file('image')->isValid()){
            //se existe uma imagem
            if ($usuario->image){
                $name = $usuario->image;
            }
            //criando o nome da imagem, ID + NOME do user.
            else{
                $name = $usuario->id.kebab_case($usuario->name); //removendo caracteres especiais.
            }

            //extensao do arquivo
            $extensaoImage = $request->image->extension();
            $nameImage = "{$name}.{$extensaoImage}";

            //atualizando o novo nome da image
            $dados['image'] = $nameImage;

            // armazenando o imagem.
            $uploadImage = $request->image->storeAs('users', $nameImage);
            if(!$uploadImage){
                redirect()->back()->with('error', 'Falha ao carregar a imagem');
            }

        }

        //atualizar apenas usuario logado.
        $att = auth()->user()->update();

        if ($att){
            return redirect()->route('perfil')->with('success', 'Sucesso ao Atualizar o Perfil');
        }
        return redirect()->back()->with('error', 'Falha ao Atualizar o Perfil');
    }
}
