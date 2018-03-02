@extends('adminlte::page')

@section('title', 'Confirmar Transferência')

@section('content_header')
    <h1>Confirmar Transferência</h1>
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

        <p><strong>Recebedor:</strong>{{$sender->name}}</p>   
        <p><strong>Saldo atual:</strong>{{number_format($balance->amount, 2, ',', '.')}}</p>        

        <form method="POST" action="{{ route('transfer.store') }}">
            {{ csrf_field() }}
            <input type="hidden" name="sender_id" value="{{ $sender->id}}">

            <div class="form-group">
                <input name="value" type="text" placeholder="Valor:" class="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Transferir</button>
            </div>
        </form>
    </div>
@stop