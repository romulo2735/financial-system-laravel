@extends('adminlte::page')

@section('title', 'Saldo')

@section('content_header')
    <h1>Saldo</h1>

    <ol class="breadcrumb">
        <li><a href="">Pagina Inicial</a></li>
        <li><a href="">Saldo </a></li>
    </ol>
@stop

@section('content')
    <div class="box-header">
        <a href="{{ route('balance.deposit') }}" class="btn btn-primary">Recarregar
            <i class="fa fa-cart-plus" aria-hidden="true"></i>
        </a>
        <a href="" class="btn btn-danger">Sacar
            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
        </a>

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
            <a href="#" class="small-box-footer">Histórico <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
@stop