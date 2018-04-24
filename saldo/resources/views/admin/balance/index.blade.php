@extends('adminlte::page')

@section('title', 'Sistema Financeiro')

@section('content_header')
    <h1>Saldo</h1>

    <ol class="breadcrumb">
        <li><a href="">Pagina Inicial</a></li>
        <li><a href="">Saldo </a></li>
    </ol>
@stop

@section('content')
    <div class="box-header">
        <a href="{{ route('balance.deposit') }}" class="btn btn-primary"><i class="fa fa-cart-plus" aria-hidden="true"></i> Recarregar </a>
        @if($amount > 0)
        <a href="{{ route('balance.saque') }}" class="btn btn-danger"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> Sacar </a>
        @endif
        @if($amount > 0)
        <a href="{{ route('balance.transferencia') }}" class="btn btn-info"><i class="fa fa-exchange"></i> Transferir </a>
        @endif

    </div>

    <div class="box-body">
        @include('admin.includes.alerts')
        <div class="small-box bg-green">
            <div class="inner">
                <h3>R$ {{number_format($amount, 2,',','.')}}</h3>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('admin.balance.historicos')}}" class="small-box-footer">Histórico <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
@stop