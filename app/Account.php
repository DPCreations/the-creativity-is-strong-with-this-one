<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['name'];

    protected $appends = ['balance'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function balance()
    {
        return $this->transactions()->whereDate('date', '<', Carbon::now())->sum('amount');
    }

    public function newTransaction($amount, $date)
    {
        return Transaction::create([
            'account_id' => $this->id,
            'amount' => $amount,
            'date' => $date
        ]);
    }
}
