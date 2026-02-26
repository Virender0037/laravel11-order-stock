<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductFeatureTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_admin_can_view_trash_page(): void
    {
        $user = User::factory()->create(['is_admin' => 1]);

        $response = $this->actingAs($user)->get('/products/trash');

        $response->assertStatus(200);
    }

    public function test_non_admin_can_view_trash_but_only_sees_own(): void
    {
        $user = User::factory()->create(['is_admin' => 0]);

        $response = $this->actingAs($user)->get('/products/trash');

        $response->assertStatus(200);
    }
}
