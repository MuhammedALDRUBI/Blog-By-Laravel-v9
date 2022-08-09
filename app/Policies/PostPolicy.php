<?php

namespace App\Policies;

use App\Models\AdminMoldels\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;



    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminMoldels\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminMoldels\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Post $post)
    {
        return ($user->id === $post->user->id) || ($user->admin === 1);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminMoldels\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Post $post)
    {
        return ($user->id === $post->user->id) || ($user->admin === 1);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AdminMoldels\Post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Post $post)
    {
        return ($user->id === $post->user->id) || ($user->admin === 1);
    }
}