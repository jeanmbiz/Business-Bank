<?php

namespace App\Services;

use App\Exceptions\AppError;
use App\Models\Transaction;
use App\Models\User;

class CreateTransactionService{

    private function findUser(string $id) {
        $user = User::find($id);

        if(is_null($user)){
            return new AppError("Usuário {$id} não encontrado ", 404);
        }

        return $user;
    }

    public function execute(array $data){


        $userPayer = $this->findUser($data['payer']);

        $userReceiver = $this->findUser($data['receiver']);

        if($userPayer->type === 'SELLER'){
            throw new AppError('Tipo de usuário inválido', 403);
        }

        if($userPayer->balance < $data['value']){
            throw new AppError('Saldo insuficiente para transação', 400);
        }

        $userPayer->balance -= $data['value'];
        $userReceiver->balance += $data['value'];

        $userPayer->save();
        $userReceiver->save();

        return Transaction::create([
            'payer_id' => $userPayer->id,
            'receiver_id' => $userReceiver->id,
            'value' => $data['value']
        ]);

    }
}
