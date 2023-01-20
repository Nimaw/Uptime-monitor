<?php

namespace App\Policies;

use App\Models\Site;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SitePolicy
{
    use HandlesAuthorization;

    public function storeEndpoint(User $user, Site $site)
    {
        return $user->id === $site->user_id;
    }
}
