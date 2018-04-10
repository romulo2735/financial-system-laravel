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
        <h3>Transferir Valor [ Informe o Recebedor ]</h3>
    </div>
    <div class="box-body">
        @include('admin.includes.alerts')
        <form method="POST" action="{{ route('transferencia.confirmar') }}">
            {!! csrf_field() !!}
            <div class="form-group">
                <input name="sender" type="text" placeholder="Informe os dados [NOME ou EMAIL]" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Proxima etapa</button>
            </div>
        </form>
    </div>
@stop