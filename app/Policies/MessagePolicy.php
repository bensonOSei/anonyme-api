<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;

class MessagePolicy
{
    // View message
    public function viewMessages( User $user, Message $message)
    {
        return $user->id===$message->send_to;
    }
}
