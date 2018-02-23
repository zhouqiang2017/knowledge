<?php

namespace App\Http\Controllers;

use App\Repositories\AnswerRepository;
use Illuminate\Http\Request;
use Auth;

/**
 * Class VotesController
 *
 * @package App\Http\Controllers
 */
class VotesController extends Controller
{
    /**
     * @var \App\Repositories\AnswerRepository
     */
    protected $answer;

    /**
     * VotesController constructor.
     *
     * @param \App\Repositories\AnswerRepository $answer
     */
    public function __construct(AnswerRepository $answer)
    {
        $this->answer = $answer;
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function users($id)
    {
        if(user('api')->hasVotedFor($id)) {
            return response()->json(['voted'=>true]);
        }
        return response()->json(['voted'=>false]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function vote()
    {
        $voted = user('api')->voteFor(request('answer'));
        $answer = $this->answer->getAnswerById(request('answer'));
        if(count($voted['attached'] )> 0){
            $answer->increment('votes_count');
            return response()->json(['voted'=>true]);
        }
        $answer->decrement('votes_count');
        return response()->json(['voted'=>false]);
    }
}
