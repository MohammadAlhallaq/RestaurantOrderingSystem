<?php

namespace Tests\Feature;

use App\Models\Account;
use Database\Factories\AccountFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AccountTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function ItCreatesAccount()
    {
        $account = Account::factory()->create();
        $this->assertDatabaseCount();
    }
}
