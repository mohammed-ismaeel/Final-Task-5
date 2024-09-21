<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

class CommentPolicy
{
    public function viewAny(User $user)
    {
        return true; // everyOne can view index
    }

    public function create(?User $user)
    {
        return $user !==null; // everyOne can create comment
    }

    public function update(User $user,Comment $comment)
    {
        return $comment->user_id === $user->id   ;
    }

    public function delete(User $user,Comment $comment)
    {
        return $comment->user_id == $user->id || $user->id == $comment->post->user_id ;
    }
}
