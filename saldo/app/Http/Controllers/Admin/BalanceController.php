<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Http\Requests\MoneyValidationFormRequest;
use App\User;

class BalanceController extends Controller
{
    private $paginacao = 4;

    public function index(){

        $balance = auth()->user()->balance;
        $amount  = $balance ? $balance->amount : 0;
        
        return view('admin.balance.index', compact('amount'));
    }

    public function deposit(){
        
        return view('admin.balance.deposit');
    }

    public function depositStore(MoneyValidationFormRequest $request){

        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->deposit($request->value);

        if ($response['success'])
            return redirect()->route('admin.balance')->with('success', $response['message']);

            return redirect()->back()->with('error', $response['message']);
    }

    public function saque(){
        return view('admin.balance.saque');
    }

    public function saqueStore(MoneyValidationFormRequest $request){

        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->saque($request->value);

        if ($response['success'])
            return redirect()->route('admin.balance')->with('success', $response['message']);

        return redirect()->back()->with('error', $response['message']);
    }

    public function Transferencia(){
        return view('admin.balance.transferencia');
    }

    public function confirmarTransferencia(Request $request, User $user){

       if (!$sender = $user->getSender($request->sender)){
            return redirect()->back()->with('error', 'Usuário informado não foi encontrado');
       }
       if ($sender->id === auth()->user()->id){
           return redirect()->back()->with('error', 'Não pode transferir para você mesmo!');
       }
       
       //recuperando o saldo do usuario para transferencia
       $balance = auth()->user()->balance;
       
       return view('admin.balance.transferencia-confirmar', compact('sender' , 'balance'));
    }

    public function transferenciaStore(MoneyValidationFormRequest $request, User $user){

        //recupera os dados que vai receber a transferencia.
        if(!$sender = $user->find($request->sender_id)){
            return redirect()->route('balance.transferencia')->with('success', 'Recebedor não encontrado');
        }

        $balance = auth()->user()->balance()->firstOrCreate([]);
        $response = $balance->transferencia($request->value, $sender);

        if ($response['success']){
            return redirect()->route('admin.balance')->with('success', $response['message']);
        }
        return redirect()->route('balance.transferencia')->with('error', $response['message']);
    }

    public function Historicos(){
        //recuperando os historicos do usuario logado.
        $historicos = auth()->user()->histories()->with(['userSender'])->paginate($this->paginacao);
        return view('admin.balance.historicos', compact('historicos'));
    }
}
