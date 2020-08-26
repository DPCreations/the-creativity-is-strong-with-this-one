<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->delete();
    }
}
