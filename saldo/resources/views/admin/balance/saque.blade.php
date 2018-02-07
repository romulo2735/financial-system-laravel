@extends('adminlte::page')

@section('title', 'Nova recarga')

@section('content_header')

    <ol class="breadcrumb">
        <li><a href="">Pagina Inicial</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Retirada</a></li>
    </ol>
@stop

@section('content')
    <div class="box-header">
        <h3>Sacar Valor</h3>
    </div>
    <div class="box-body">
        @include('admin.includes.alerts')
        <form method="POST" action="{{ route('saque.store') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <input name="value" type="text" placeholder="Digite o valor do saque" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Sacar</button>
            </div>
        </form>
    </div>
@stop