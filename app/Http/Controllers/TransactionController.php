<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepositRequest;
use App\Http\Requests\CreateTransferenceRequest;
use App\Services\CreateDepositService;
use App\Services\CreateTransferenceService;

class TransactionController extends Controller
{
    protected $createDepositService;

    protected $createTransferenceService;

    public function __construct(CreateDepositService $createDepositService, CreateTransferenceService $createTransferenceService)
    {
        $this->createDepositService = $createDepositService;
        $this->createTransferenceService = $createTransferenceService;
    }

    public function deposit(CreateDepositRequest $request)
    {
        return $this->createDepositService->execute($request->all());
    }

    public function transference(CreateTransferenceRequest $request)
    {
        return $this->createTransferenceService->execute($request->all());
    }
}
