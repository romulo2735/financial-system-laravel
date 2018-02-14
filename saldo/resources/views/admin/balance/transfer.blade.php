@extends('adminlte::page')

@section('title', 'Transferir')

@section('content_header')

    <ol class="breadcrumb">
        <li><a href="">Pagina Inicial</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Depositar</a></li>
        <li><a href="">Transferir</a></li>
    </ol>
@stop

@section('content')
    <div class="box-header">
        <h3>Transferir Saldo (Informe o Recebedor)</h3>
    </div>
    <div class="box-body">
        @include('admin.includes.alerts')
        <form method="POST" action="{{ route('transfer.store') }}">
            {{ csrf_field() }}
            <div class="form-group">
                <input name="sender" type="text" placeholder="Informação de quem vai receber o valor (Nome ou Email)" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Proxima etapa</button>
            </div>
        </form>
    </div>
@stop