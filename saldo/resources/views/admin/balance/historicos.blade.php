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
        <form action="{{ route('historico.pesquisa')  }}" method="post" class="form form-inline">
            {!! csrf_field() !!}
            <input type="text" name="id" class="form-control" placeholder="ID">
            <input type="date" name="date" class="form-control" placeholder="dd/mm/aaaa">
            <select name="type" class="form-control">
                <option value="">-- Selecione --</option>
                @foreach($types as $type)
                    <option value="{{ $type  }}">{{ $type  }}</option>
               @endforeach
            </select>

            <button type="submit" class="btn btn-primary">Pesquisar</button>
            <button type="reset" class="btn btn-warning">Limpar</button>
        </form>
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