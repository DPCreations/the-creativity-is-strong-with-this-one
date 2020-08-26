<?php

namespace App\Http\Controllers\Api;

use App\Account;
use App\Http\Controllers\Controller;
use App\Transaction;
use Carbon\Carbon;

class AccountTransactionsController extends Controller
{
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

        $account->newTransaction(request('amount'), $date);

        return response('success', 201);
    }
}
