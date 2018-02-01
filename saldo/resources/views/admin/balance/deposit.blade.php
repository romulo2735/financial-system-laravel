@extends('adminlte::page')

@section('title', 'Nova recarga')

@section('content_header')
    <h1>Fazer recarga</h1>

    <ol class="breadcrumb">
        <li><a href="">Pagina Inicial</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Depositar</a></li>
    </ol>
@stop

@section('content')
    <div class="box-header">
        <h3>Fazer Recarga</h3>
    </div>
    <div class="box-body">
        <form method="POST" action="{{ route('deposit.store') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <input value="" type="text" placeholder="Valor da Recarga" class="form-control">
            </div>
            <div class="form-group">   
                <button class="btn btn-success" type="submit">Recarregar</button>
            </div>
        </form>    
    </div>
@stop