<?php

namespace App\Http\Controllers;

use App\Repositories\TopicRepository;
use Illuminate\Http\Request;

/**
 * Class TopicController
 *
 * @package App\Http\Controllers
 */
class TopicController extends Controller
{
    /**
     * @var \app\Repositories\TopicRepository
     */
    protected $topic;
    /**
     * TopicController constructor.
     *
     * @param \app\Repositories\TopicRepository $topic
     */
    public function __construct(TopicRepository $topic)
    {
        $this->topic = $topic;
    }
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $topics = $this->topic->getTopicsForTagging($request);
        return response()->json($topics);
    }
}
