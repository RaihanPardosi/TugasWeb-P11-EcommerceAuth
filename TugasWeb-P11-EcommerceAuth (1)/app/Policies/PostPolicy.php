<?php

namespace App\Policies;

use App\Enums\Role;
use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, Post $post): bool
    {
        if ($post->isPublished() && $post->published_at?->isPast()) {
            return true;
        }

        return $user !== null && ($user->isAdmin() || $user->id === $post->user_id);
    }

    public function create(User $user): bool
    {
        return $user->hasRole(Role::Admin, Role::Editor);
    }

    public function update(User $user, Post $post): bool
    {
        return $user->isAdmin()
            || ($user->isEditor() && $user->id === $post->user_id);
    }

    public function delete(User $user, Post $post): bool
    {
        return $this->update($user, $post);
    }
}
