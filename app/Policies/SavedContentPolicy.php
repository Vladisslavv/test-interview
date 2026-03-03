<?php

namespace App\Policies;

use App\Models\SavedContent;
use App\Models\User;

class SavedContentPolicy
{
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SavedContent $savedContent): bool
    {
        return $user->id === $savedContent->user_id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SavedContent $savedContent): bool
    {
        return $user->id === $savedContent->user_id;
    }
}
