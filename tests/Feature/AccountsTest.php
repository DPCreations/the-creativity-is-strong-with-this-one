<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class AccountsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_list_accounts()
    {
        $response = $this->get(route('api.accounts.index'));

        $response->assertStatus(200);
    }

    /** @test */
    public function can_store_accounts()
    {
        $response = $this->post(route('api.accounts.store'), [
            'name' => Str::random(10)
        ]);

        $response->assertStatus(200);
    }
}
