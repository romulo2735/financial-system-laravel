<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

class History extends Model
{
    protected $fillable = ['type', 'amount', 'total_before', 'total_after', 'user_id_transaction', 'date'];

    //relacionamento USUARIO -  HISTORICO
    public function user(){
        return $this->belongsTo(User::class);
    }

    //relacionamento: Pegando a informação de quem transferiu
    public function userSender(){
        return $this->belongsTo(User::class, 'user_id_transaction');
    }

    public function type($type = null){
        $types = [
            'I' => 'Recarga',
            'T' => 'Transferência',
            'O' => 'Saque'
        ];

        if (!$type) {
            return $types;
        }
        return $types[$type];

        //recuperando o tipo de entrada, tranferencia ou não.
        if ($this->user_id_transaction != null && $type == 'I'){
            return 'Recebido';
        }
    }

    public function getDateAttribute($value){
        //return Carbon::parse($value)->format('d/m/Y - H:m:s');
        return Carbon::parse($value)->format('d/m/Y');
    }

    /**
     * Get the relationships for the entity.
     *
     * @return array
     */
    public function getQueueableRelations()
    {
        // TODO: Implement getQueueableRelations() method.
    }
}
