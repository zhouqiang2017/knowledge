<?php

namespace App\Repositories;
use App\Comment;

/**
 * Class QuestionRepository
 *
 * @package \App\Repositories
 */
class CommentRepository
{
    public function createComment(array $attributes)
    {
        return Comment::firstOrCreate($attributes);
    }
}
