<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

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
}
