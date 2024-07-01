<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class HotelPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'owner'])
            ? Response::allow()
            : Response::deny('You must be an Admin or Owner to create hotels.');
    }

    public function delete(User $user)
    {
        return $user->role === 'owner'
            ? Response::allow()
            : Response::deny('You must be an Owner to delete hotels.');
    }

}
