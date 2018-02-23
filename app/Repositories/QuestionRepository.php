<?php

namespace App\Repositories;
use App\Question;
use App\Topic;

/**
 * Class QuestionRepository
 *
 * @package \App\Repositories
 */
class QuestionRepository
{
    /**
     * @param $id
     *
     * @return mixed
     */
    public function getQuestionByIdWithTopics($id)
    {
        return Question::with(['topics','answers'])->findOrFail($id);
    }

    /**
     * @param array $attributes
     *
     * @return mixed
     */
    public function createQuestion(array $attributes)
    {
        return Question::firstOrCreate($attributes);
    }

    /**
     * @param array $topics
     *
     * @return array
     */
    public function normalizeTopic(array $topics)
    {
        $ids = Topic::pluck('id');
        $ids = collect($topics)->map(function ($topic) use ($ids) {
            if (is_numeric($topic) && $ids->contains($topic)) {
                return (int)$topic;
            }
            return Topic::firstOrCreate(['name' => $topic])->id;
        })->toArray();
        Topic::whereIn('id', $ids)->increment('questions_count');
        return $ids;
    }

    /**
     * @return mixed
     */
    public function getQuestionsFeed()
    {
        return Question::published()->latest('updated_at')->with('user')->get();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getQuestionCommentsById($id)
    {
        return Question::with('comments','comments.user')->where('id',$id)->firstOrFail()->comments;
    }


}
