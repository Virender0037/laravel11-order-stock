<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_customers_index(): void
    {
        $response = $this->get('/customers')
                 ->assertRedirect('/login');
    }

    public function test_auth_user_can_view_customers_index(): void
    {
        $user = User::factory()->create();
            
        $this->actingAs($user)->get('/customers')->assertOk();
    }

    public function test_auth_user_can_create_customers(): void
    {   
        $user = User::factory()->create();

        $customerdata = Customer::factory()->make()->toArray();

        $this->actingAs($user)
         ->post('/customers', $customerdata)
         ->assertRedirect('/customers');

        $this->assertDatabaseHas('customers', [
            'email' => $customerdata['email'],
        ]);

    }

    public function test_duplicate_emails_fails_validation(): void
    {
        $user = User::factory()->create();

        $existing = Customer::factory()->create([
          'email' => 'same@same.com',
        ]);

        $payload = Customer::factory()->make([
        'email' => $existing->email,
        ])->toArray();

        $this->actingAs($user)
        ->post('/customers', $payload)
        ->assertSessionHasErrors(['email']);

    }

    public function test_auth_user_can_update_customers(): void
    {   
        $user = User::factory()->create();

        $customer = Customer::factory()->create();

        $updatedata = Customer::factory()->make()->toArray();

        $this->actingAs($user)
        ->put("/customers/{$customer->id}", $updatedata)
        ->assertRedirect('/customers');

        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'email' => $updatedata['email'],
        ]);
    }

    public function test_auth_user_can_delete_customers(): void
    {   
        $user = User::factory()->create();

        $customer = Customer::factory()->create();

        $this->actingAs($user)
        ->delete("/customers/{$customer->id}")
        ->assertRedirect('/customers');

        $this->assertDatabaseMissing('customers', [
            'id' => $customer->id,
        ]);
    }
}
