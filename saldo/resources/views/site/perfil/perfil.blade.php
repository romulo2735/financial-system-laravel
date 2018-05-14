@extends('site.layouts.layout')
@section('title', 'Meu Perfil')

@section('content')
    <h1>Meu Perfil</h1>

     @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
     @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
     @endif

    <form action="{{route('perfil.atualizar')}}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="name">Nome: </label>
            <input class="form-control" value="{{auth()->user()->name}}" type="text" name="name" placeholder="Nome">
        </div>
        <div class="form-group">
            <label for="email">E-Mail: </label>
            <input class="form-control" value="{{auth()->user()->email}}" type="text" name="email" placeholder="E-mail">
        </div>
        <div class="form-group">
            <label for="password">Senha: </label>
            <input class="form-control" type="password" name="password" placeholder="Senha">
        </div>
        <div class="form-group">
            <label for="image">Imagem: </label>
            <input class="form-control" type="file" name="image">
        </div>
        <div class="form-group">
            <button  type="submit" class="btn btn-info">Atualizar Perfil</button>
        </div>
    </form>









@endsection