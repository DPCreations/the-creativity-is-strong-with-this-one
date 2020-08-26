<?php

namespace App;

use App\Exceptions\TransactionException;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = ['name'];

    protected $appends = ['balance'];

    /**
     * Get all of this accounts transactions
     *
     * @return object
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Calculate the balance from all of the accounts past transactions
     *
     * @return integer
     */
    public function getBalanceAttribute()
    {
        return $this->transactions()->whereDate('date', '<', Carbon::now())->sum('amount');
    }

    /**
     * Generate a new transaction for the given account.
     *
     * @param int $amount
     * @param $date
     * @param $description
     *
     * @return object
     * @throws TransactionException
     */
    public function newTransaction($amount, $date = null, $description = null)
    {
        $date = $date ? $date : Carbon::now();

        if($amount) {
            return Transaction::create([
                'account_id' => $this->id,
                'amount' => $amount,
                'date' => $date,
                'description' => $description
            ]);
        }

        throw new TransactionException("Missing amount for transaction.");
    }
}
