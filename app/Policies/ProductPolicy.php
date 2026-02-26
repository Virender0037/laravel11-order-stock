<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;

class ProductPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Product $product)
    {
        return true;
    }

    public function create(User $user)
    {
        return (int)$user->is_admin === 1;
    }

    public function update(User $user, Product $product)
    {
        return (int)$user->is_admin === 1 || $product->created_by === (int)$user->id;
    }

    public function delete(User $user, Product $product)
    {
        return (int)$user->is_admin === 1 || $product->created_by === (int)$user->id;
    }

     public function restore(User $user, Product $product)
    {
        return (int)$user->is_admin === 1;
    }

    public function forceDelete(User $user, Product $product)
    {
        return (int)$user->is_admin === 1;
    }

    public function viewTrashed(User $user)
    {
        return true;
    }
}
