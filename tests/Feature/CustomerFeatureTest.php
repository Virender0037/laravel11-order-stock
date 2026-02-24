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

    public function test_duplicate_emails(): void
    {

    }

    public function test_auth_user_can_update_customers(): void
    {   
        $customer = Customer::factory()->create();

        $user = User::factory()->create();

        $updateddata = Customer::factory()->make()->toArray();

        $this->actingAs($user)
         ->put("/customers/{$customer->id}", $updateddata);
        
        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'email' => $updatedData['email'],
        ]);

    }

    public function test_auth_user_can_delete_customers(): void
    {   
        $customer = Customer::factory()->create();

        $user = User::factory()->create();


    }
}
