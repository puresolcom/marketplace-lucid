<?php

namespace App\Domains\User\Events;

use App\Data\Models\User;
use App\Events\Event;

class UserUpdatedEvent extends Event
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}