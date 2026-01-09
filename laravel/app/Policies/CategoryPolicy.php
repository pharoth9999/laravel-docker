<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Category $category): bool
    {
        if ($user->hasRole('manager')) {
            $productCreatorId = $category->product?->created_by;

            return $productCreatorId !== null && $productCreatorId === $user->id;
        }

        if ($user->hasRole('staff')) {
            return $category->assigned_to === $user->id;
        }

        return false;
    }

    public function updateStatus(User $user, Category $category): bool
    {
        return $user->hasRole('staff') && $category->assigned_to === $user->id;
    }
}
