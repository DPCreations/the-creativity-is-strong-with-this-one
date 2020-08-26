<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('api')->name('api.')->group(function() {
    Route::name('accounts.')->prefix('accounts')->group(function() {
        Route::get('/index', 'AccountsController@index')->name('index');
        Route::post('/store', 'AccountsController@store')->name('store');

        Route::name('transactions.')->group(function() {
            Route::get('{accountId}/transactions/index', 'AccountTransactionsController@index')->name('index');
            Route::post('{accountId}/transactions/store', 'AccountTransactionsController@store')->name('store');
        });
    });

    Route::post('transactions/{transactionId}/destroy', 'TransactionsController@destroy')->name('transactions.destroy');
});
