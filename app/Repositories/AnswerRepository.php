<?php

namespace App\Repositories;
use App\Answer;

/**
 * Class AnswerRepository
 *
 * @package \App\Repositories
 */
class AnswerRepository
{
    public function createAnswer(array $attributes)
    {
        return Answer::firstOrCreate($attributes);
    }
}
