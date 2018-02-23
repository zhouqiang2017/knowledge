<?php

namespace App\Http\Controllers;

use App\Repositories\AnswerRepository;
use App\Repositories\CommentRepository;
use App\Repositories\QuestionRepository;
use Auth;
/**
 * Class CommentsController
 *
 * @package App\Http\Controllers
 */
class CommentsController extends Controller
{
    /**
     * @var \App\Repositories\AnswerRepository
     */
    protected $answer;
    /**
     * @var \App\Repositories\QuestionRepository
     */
    protected $question;
    /**
     * @var \app\Repositories\CommentsRepository
     */
    protected $comment;

    /**
     * CommentsController constructor.
     *
     * @param \App\Repositories\AnswerRepository   $answer
     * @param \App\Repositories\QuestionRepository $question
     * @param \app\Repositories\CommentsRepository $comment
     */
    public function __construct(CommentRepository $comment, AnswerRepository $answer, QuestionRepository $question)
    {
        $this->answer = $answer;
        $this->question = $question;
        $this->comment = $comment;
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function answer($id)
    {
        return $this->answer->getAnswerCommentsById($id);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function question($id)
    {
        return $this->question->getQuestionCommentsById($id);
    }

    /**
     * @return mixed
     */
    public function store()
    {
        $model = $this->getModelNameFromType(request('type'));
        return $this->comment->createComment([
            'commentable_id' => request('model'),
            'commentable_type' => $model,
            'user_id' => user('api')->id,
            'body' => request('body')
        ]);
    }

    /**
     * @param $type
     *
     * @return string
     */
    public function getModelNameFromType($type)
    {
        return $type === 'question'? 'App\Question':'App\Answer';
    }
}
