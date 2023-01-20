<?php

namespace App\Policies;

use App\Models\Endpoint;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EndpointPolicy
{
    use HandlesAuthorization;

    public function destroyEndpoint(User $user, Endpoint $endpoint)
    {
        return $user->id === $endpoint->site->user_id;
    }
}
