<?php

namespace App\Http\Controllers;

use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use Auth;

/**
 * Class QuestionFollowController
 *
 * @package App\Http\Controllers
 */
class QuestionFollowController extends Controller
{
    /**
     * @var \App\Repositories\QuestionRepository
     */
    protected $question;

    /**
     * QuestionFollowController constructor.
     *
     * @param \App\Repositories\QuestionRepository $question
     */
    public function __construct(QuestionRepository $question)
    {
        $this->middleware('auth');
        $this->question = $question;
    }

    /**
     * @param $question
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function follow($question)
    {
        Auth::user()->followThis($question);
        return back();
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function follower(Request $request)
    {
        $followed = user('api')->followed($request->get('question'));
        if ($followed) {
            return response()->json(['followed' => true]);
        }
        return response()->json(['followed' => false]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function followThisQuestion(Request $request)
    {
        $question = $this->question->getQuestionByIdWithTopics($request->get('question'));
        $followed = user('api')->followThis($question->id);
        if (count($followed['detached']) > 0) {
            $question->decrement('followers_count');
            return response()->json(['followed' => false]);
        }
        $question->increment('followers_count');
        return response()->json(['followed' => true]);
    }
    //
}
