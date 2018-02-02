<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model{
    
    /* Removido da migration, para não criar as colunas create_at e update_at */
    public $timestamps = false;

    public function deposit(float $value) : Array{
        
        $this->amount += number_format($value, 2, '.', '') ;
        $deposit = $this->save();

        if ($deposit){
            return[
                'sucess'    =>  true,
                'messege'   =>  'Sucesso ao recerregar'
            ];
            return[
                'sucess'    =>  false,
                'messege'   =>  'Falha ao recerregar'
            ];
        }

    }
}
