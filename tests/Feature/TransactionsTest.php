<?php

namespace Tests\Feature;

use App\Account;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionsTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /** @test */
    public function can_list_transaction()
    {
        $account = factory(Account::class)->create();

        $response = $this->get(route('api.accounts.transactions.index', $account->id));

        $response->assertStatus(200);
    }

    /** @test */
    public function displays_error_when_passing_unknown_id()
    {
        $response = $this->get(route('api.accounts.transactions.index', 1));

        $response->assertStatus(404);
    }

    /** @test */
    public function can_create_positive_transaction()
    {
        $account = factory(Account::class)->create();

        $response = $this->post(route('api.accounts.transactions.store', $account->id), [
            'amount' => rand(0, 100),
            'date' => $this->faker->dateTimeBetween('now', '+1 year')
        ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function can_create_negative_transaction()
    {
        $account = factory(Account::class)->create();

        $response = $this->post(route('api.accounts.transactions.store', $account->id), [
            'amount' => rand(-100, -1),
            'date' => $this->faker->dateTimeBetween('now', '+1 year')
        ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function cannot_create_transaction_in_past()
    {
        $account = factory(Account::class)->create();

        $response = $this->post(route('api.accounts.transactions.store', $account->id), [
            'amount' => rand(0, 100),
            'date' => $this->faker->dateTimeBetween('-10 years', '-1 year')
        ]);

        $response->assertStatus(400);
    }

    /** @test */
    public function cannot_create_null_transaction_from_endpoint()
    {
        $account = factory(Account::class)->create();

        $response = $this->post(route('api.accounts.transactions.store', $account->id), [
            'amount' => null,
            'date' => null
        ]);

        $response->assertStatus(302);
    }

    /** @test */
    public function can_delete_transaction()
    {
        $account = factory(Account::class)->create();
        $transaction = $account->charge(100, Carbon::now());

        $response = $this->post(route('api.transactions.destroy', $transaction->id));

        $response->assertStatus(200);
    }
}
