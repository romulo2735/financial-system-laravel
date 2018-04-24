@extends('adminlte::page')

@section('title', 'Saldo')

@section('content_header')
    <h1>Saldo</h1>

    <ol class="breadcrumb">
        <li><a href="">Pagina Inicial</a></li>
        <li><a href="">Histórico de Movimentações </a></li>
    </ol>
@stop

@section('content')
    <div class="box-header">

    </div>

    <div class="box-body">
      <table class="table table-striped">
          <thead>
              <tr>
                  <th>#</th>
                  <th>Valor</th>
                  <th>Tipo</th>
                  <th>Data</th>
                  <th>Sender</th>
              </tr>
          </thead>
          <tbody>
                @forelse($historicos as $historico)  
                <tr>
                    <td>{{ $historico->id }}</td>                  
                    <td>{{ number_format($historico->amount,2, ',' , '.' ) }}</td>                  
                    <td>{{ $historico->type($historico->type) }}</td>       
                    <td>{{ $historico->date }}</td>           
                    <td>@if($historico->user_id_transaction)
                            {{ $historico->userSender->name}}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @empty
                @endforelse
          </tbody>
      </table>
        {!! $historicos->links() !!}
    </div>
@stop