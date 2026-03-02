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
        $admin = User::factory()->create(['is_admin' => 1]);
        $response = $this->actingAs($admin)->get(route('products.trash'))->assertOk();
    }

    public function test_non_admin_can_view_trash_but_only_sees_own(): void
    {   
        $admin = User::factory()->create(['is_admin' => 1]);
        $user = User::factory()->create(['is_admin' => 0]);

        $adminproduct = Product::factory()->create(['created_by' => $admin->id]);
        $userproduct = Product::factory()->create(['created_by' => $user->id]);

        $adminproduct->delete();
        $userproduct->delete();

        $response = $this->actingAs($user)->get(route('products.trash'))->assertOk();
        $response->assertSee($userproduct->name);
        $response->assertDontSee($adminproduct->name);
    }

    public function test_soft_delete_moves_product_to_trash(): void
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $product = Product::factory()->create(['created_by' => $admin->id]);

        $this->actingAs($admin)->delete(route('products.destroy', $product))->assertRedirect();
        $this->assertSoftDeleted('products', ['id' => $product->id]);
    }

    public function test_admin_can_restore_trashed_products(): void
    {
        $admin = User::factory()->create(['is_admin' => 1]);
        $product = Product::factory()->create(['created_by' => $admin->id]);
        $product->delete();

        $this->actingAs($admin)->patch(route('products.restore', $product->id))->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', ['id' => $product->id, 'deleted_at' => null]);

    }

    public function test_non_admin_cannot_restore_or_force_delete(): void
    {   
        $admin = User::factory()->create(['is_admin' => 1]);
        $user = User::factory()->create(['is_admin' => 0]);

        $adminproduct = Product::factory()->create(['created_by' => $admin->id]);
        $adminproduct->delete();

        $this->actingAs($user)->patch(route('products.restore', $adminproduct->id))->assertForbidden();
        $this->actingAs($user)->patch(route('products.permanentdelete', $adminproduct->id))->assertForbidden();
    }
}
