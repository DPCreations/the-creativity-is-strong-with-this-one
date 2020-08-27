<?php

namespace App\Http\Controllers\Api;

use App\Account;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;

class AccountTransactionsController extends Controller
{
    /**
     * Show a listing of transactions for a given account
     *
     * @param int $accountId
     * @return void
     * @throws Exception
     */
    public function index($accountId)
    {
        $account = Account::findOrFail($accountId);

        return $account->transactions->sortBy('date');
    }

    public function store($accountId)
    {
        $account = Account::findOrFail($accountId);

        request()->validate([
            'amount' => 'required|integer',
            'date' => 'required|date'
        ]);

        $date = Carbon::parse(request('date'));

        if($date->isPast() && !$date->isSameMinute(Carbon::now())) {
            return response('error', 400);
        }

        $account->charge(request('amount'), $date);

        return response('success', 201);
    }
}
