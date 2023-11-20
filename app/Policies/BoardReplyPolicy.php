<?php

namespace App\Policies;

use App\Models\BoardReply;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BoardReplyPolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BoardReply $boardReply): bool
    {
        return $user->id === $boardReply->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BoardReply $boardReply): bool
    {
        return $user->id === $boardReply->user_id;
    }
}
