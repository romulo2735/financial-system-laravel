@extends('adminlte::page')

@section('title', 'Confirmar Transferência')

@section('content_header')
    <ol class="breadcrumb">
        <li><a href="">Pagina Inicial</a></li>
        <li><a href="">Saldo</a></li>
        <li><a href="">Depositar</a></li>
        <li><a href="">Transferir</a></li>
        <li><a href="">Confirmação</a></li>
    </ol>
@stop

@section('content')
    <div class="box-header">
        <h3>Confirmar Transferência</h3>
    </div>
    <div class="box-body">
        @include('admin.includes.alerts')

        <p><strong>Recebedor: </strong>{{$sender->name}}</p>
        <p><strong>Saldo atual: </strong>R$ {{number_format($balance->amount, 2, ',', '.')}}</p>

        <form method="POST" action="{{ route('transferencia.store') }}">
            {{ csrf_field() }}
            <input type="hidden" name="sender_id" value="{{ $sender->id}}">

            <div class="form-group">
                <input name="value" type="text" placeholder="Insira um valor para transferir" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Transferir</button>
            </div>
        </form>
    </div>
@stop