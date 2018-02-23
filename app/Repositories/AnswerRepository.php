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
    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function createAnswer(array $attributes)
    {
        return Answer::firstOrCreate($attributes);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getAnswerById($id)
    {
        return Answer::findOrFail($id);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getAnswerCommentsById($id)
    {
        return Answer::with('comments','comments.user')->where('id',$id)->firstOrFail()->comments;
    }
}
