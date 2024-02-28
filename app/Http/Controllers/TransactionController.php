<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDepositRequest;
use App\Http\Requests\CreateTransferenceRequest;
use App\Services\Transaction\CreateDepositService;
use App\Services\Transaction\CreateTransferenceService;
use App\Services\Transaction\DeleteDepositService;
use App\Services\Transaction\DeleteTransferenceService;
use App\Services\Transaction\ListOwnBalanceService;
use App\Services\Transaction\ListOwnTransactionsService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $createDepositService;

    protected $listOwnTransactionsService;

    protected $listOwnBalanceService;

    protected $createTransferenceService;

    protected $deleteDepositService;

    protected $deleteTransferenceService;

    public function __construct(CreateDepositService $createDepositService, CreateTransferenceService $createTransferenceService,
        ListOwnTransactionsService $listOwnTransactionsService, ListOwnBalanceService $listOwnBalanceService, DeleteDepositService $deleteDepositService,
        DeleteTransferenceService $deleteTransferenceService)
    {
        $this->createDepositService = $createDepositService;
        $this->createTransferenceService = $createTransferenceService;
        $this->listOwnTransactionsService = $listOwnTransactionsService;
        $this->listOwnBalanceService = $listOwnBalanceService;
        $this->deleteDepositService = $deleteDepositService;
        $this->deleteTransferenceService = $deleteTransferenceService;

    }

    public function deposit(CreateDepositRequest $request)
    {
        return $this->createDepositService->execute($request->all());
    }

    public function transference(CreateTransferenceRequest $request)
    {
        return $this->createTransferenceService->execute($request->all());
    }

    public function listOwnTransactions(Request $request)
    {

        return $this->listOwnTransactionsService->execute($request);
    }

    public function listOwnBalance(Request $request)
    {

        return $this->listOwnBalanceService->execute($request);
    }

    public function deleteDeposit(Request $request)
    {
        return $this->deleteDepositService->execute($request);
    }

    public function deleteTransference(Request $request)
    {
        return $this->deleteTransferenceService->execute(($request));
    }
}
