@extends('adminlte::page')

@section('title', 'Nova recarga')

@section('content_header')
    
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
        @include('admin.includes.alerts')
        <form method="POST" action="{{ route('deposit.store') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <input name="value" type="text" placeholder="Digite o valor da recarga" class="form-control">
            </div>
            <div class="form-group">   
                <button class="btn btn-success" type="submit">Recarregar</button>
            </div>
        </form>    
    </div>
@stop