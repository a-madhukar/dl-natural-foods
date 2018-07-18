<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Product;

class ProductPolicy
{
    use HandlesAuthorization;

    public function update(User $user)
    {
        return $user->isAdmin() == 1; 
    }
}
