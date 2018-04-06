<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;

class Balance extends Model{
    
    /* Removido da migration, para não criar as colunas create_at e update_at */
    public $timestamps = false;

    public function deposit(float $value) : Array{

        DB::beginTransaction();

        //Se for diferente de NULL ele recebe ele mmesmo
        $totalBefore = $this->amount ? $this->amount : 0;
        
        $this->amount += number_format($value, 2, '.', '') ;
        $deposit = $this->save();

        $historic = auth()->user()->histories()->create([ 
        'type'          =>  'I', //entrada
        'amount'        =>  $value,// valor que foi feita a recarga
        'total_before'  =>  $totalBefore, // total do valor antes.
        'total_after'   =>  $this->amount, //total valor dps da recarga
        'date'          =>  date('Ymd'),
        ]);

        if ($deposit && $historic){
            DB::commit();
            return [
                'success'    =>  true,
                'message'   =>  'Sucesso ao recerregar'
            ];
        }
        else{
            DB::rollback();
            return[
                'success'    =>  false,
                'message'   =>  'Falha ao recerregar'
            ];
        }

    }

    public function saque(float $value) : array {

        //verificando se o usuario tem dinheiro disponivel para sacar.
        if ($this->amount < $value){
            return[
                'success'   =>  false,
                'message'   =>  'Saldo Insucifiente',
            ];
        }

        DB::beginTransaction();

        //Se for diferente de NULL ele recebe ele mmesmo
        $totalBefore = $this->amount ? $this->amount : 0;

        $this->amount -= number_format($value, 2, '.', '') ;
        $saque = $this->save();

        $historic = auth()->user()->histories()->create([
            'type'          =>  'O', //entrada
            'amount'        =>  $value,// valor que foi feita a recarga
            'total_before'  =>  $totalBefore, // total do valor antes.
            'total_after'   =>  $this->amount, //total valor dps da recarga
            'date'          =>  date('Ymd'),
        ]);

        if ($saque && $historic){
            DB::commit();
            return [
                'success'   =>  true,
                'message'   =>  'Sucesso ao sacar'
            ];
        }
        else{
            DB::rollback();
            return[
                'success'   =>  false,
                'message'   =>  'Falha ao sacar'
            ];
        }
    }

    public function transferencia(float $value, User $sender): Array {
        //verificando se o usuario tem dinheiro disponivel para transferir.
        if ($this->amount < $value){
            return[
                'success'   =>  false,
                'message'   =>  'Saldo Insucifiente',
            ];
        }

        DB::beginTransaction();

        //ATUALIZAR O PROPRIO SALDO DE QUEM TRANSFERE
        $totalBefore = $this->amount ? $this->amount : 0;

        $this->amount -= number_format($value, 2, '.', '') ;
        $tranferencia = $this->save();

        $historic = auth()->user()->histories()->create([
            'type'                  =>  'T', //entrada
            'amount'                =>  $value,// valor que foi feita a recarga
            'total_before'          =>  $totalBefore, // total do valor antes.
            'total_after'           =>  $this->amount, //total valor dps da recarga
            'date'                  =>  date('Ymd'),
            'user_id_transaction'   =>  $sender->id
        ]);

        //ATUALIZAR O PROPRIO SALDO DE QUEM RECEBE A TRANSFERENCIA
        $senderBalance = $sender->balance()->firstOrCreate([]);
        $totalBeforeSender = $senderBalance->amount ? $senderBalance->amount: 0;
        $this->amount += number_format($value, 2, '.', '') ;
        $tranferenciaSender = $senderBalance->save();

        $historicSender = auth()->user()->histories()->create([
            'type'                  =>  'T', //entrada
            'amount'                =>  $value,// valor que foi feita a recarga
            'total_before'          =>  $totalBeforeSender, // total do valor antes.
            'total_after'           =>  $this->amount, //total valor dps da recarga
            'date'                  =>  date('Ymd'),
            'user_id_transaction'   =>  auth()->user()->id,
        ]);

        if ($tranferencia && $historic && $tranferenciaSender && $historicSender){
            DB::commit();
            return [
                'success'   =>  true,
                'message'   =>  'Sucesso ao Transferir'
            ];
        }
            DB::rollback();
            return[
                'success'   =>  false,
                'message'   =>  'Falha ao transferir'
            ];
    }
}
