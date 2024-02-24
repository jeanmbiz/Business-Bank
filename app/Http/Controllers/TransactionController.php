<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepositRequest;
use App\Http\Requests\CreateTransferenceRequest;
use App\Services\Transaction\CreateDepositService;
use App\Services\Transaction\CreateTransferenceService;
use App\Services\Transaction\ListOwnBalanceService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $createDepositService;
    protected $listOwnBalanceService;
    protected $createTransferenceService;

    public function __construct(CreateDepositService $createDepositService, CreateTransferenceService $createTransferenceService, ListOwnBalanceService $listOwnBalanceService)
    {
        $this->createDepositService = $createDepositService;
        $this->listOwnBalanceService = $listOwnBalanceService;
        $this->createTransferenceService = $createTransferenceService;
    }

    public function deposit(CreateDepositRequest $request)
    {
        return $this->createDepositService->execute($request->all());
    }

    public function listOwnBalance(Request $request){

        return $this->listOwnBalanceService->execute($request);
    }

    public function transference(CreateTransferenceRequest $request)
    {
        return $this->createTransferenceService->execute($request->all());
    }
}
