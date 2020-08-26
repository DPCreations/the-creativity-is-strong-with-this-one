<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Delete a transaction with the given id
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->delete();
    }
}
