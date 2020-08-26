<?php

namespace App\Http\Controllers\Api;

use App\Account;
use App\Http\Controllers\Controller;

class AccountsController extends Controller
{
    public function index()
    {
        return Account::orderBy('name')->get();
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|string|unique:accounts,name'
        ]);

        Account::create([
            'name' => request('name')
        ]);

        return response('success', 200);
    }
}
