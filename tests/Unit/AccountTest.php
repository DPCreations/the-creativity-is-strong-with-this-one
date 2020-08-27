<?php

namespace Tests\Unit;

use App\Account;
use App\Exceptions\TransactionException;
use Carbon\Carbon;
use Tests\TestCase;

class AccountTest extends TestCase
{
    /** @test */
    public function throws_exception_on_null_amount_transaction()
    {
        $account = factory(Account::class)->create();

        $this->expectException(TransactionException::class);
        $this->expectExceptionMessage("Missing amount for transaction.");

        $account->charge(null, null);
    }

    /** @test */
    public function balance_is_calculated_correct()
    {
        $account = factory(Account::class)->create();

        for($i = 1; $i < 6; $i++) {
            $account->charge(100, Carbon::now()->addDays(-$i));
        }

        $this->assertEquals(500, $account->balance);
    }

    /** @test */
    public function balance_do_not_include_future_transactions()
    {
        $account = factory(Account::class)->create();

        for($i = 1; $i < 6; $i++) {
            $account->charge(100, Carbon::now()->addDays(-$i));
        }

        for($i = 1; $i < 6; $i++) {
            $account->charge(100, Carbon::now()->addDays($i));
        }

        $this->assertEquals(500, $account->balance);
    }
}
