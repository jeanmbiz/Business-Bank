<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepositRequest;
use App\Http\Requests\CreateTransactionRequest;
use App\Services\CreateDepositService;
use App\Services\CreateTransactionService;

class TransactionController extends Controller
{
    protected $createDepositService;

    public function __construct(CreateDepositService $createDepositService)
    {
        $this->createDepositService = $createDepositService;
    }

    public function deposit(CreateDepositRequest $request)
    {
        return $this->createDepositService->execute($request->all());
    }


    public function create(CreateTransactionRequest $request)
    {
        $createTransactionService = new CreateTransactionService();

        return $createTransactionService->execute($request->all());
    }


}
