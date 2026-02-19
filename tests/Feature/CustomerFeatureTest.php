<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerFeatureTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_guest_cannot_access_customers_index(): void
    {
        $response = $this->get('/customers');

        $response->assertRedirect('/login');
    }
}
