<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Comment;
use App\Question;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function answer($id)
    {
        $commnets = Answer::with('commnets','commnet.user')->where('commnetable_id',$id)->firstOrFail();
//        return response()->json([]);
        return $commnets;
    }
    public function question($id)
    {
        $commnets = Question::with('commnets','commnet.user')->where('commnetable_id',$id)->firstOrFail();
//        return response()->json([]);
        return $commnets;
    }
    public function store()
    {
        $model = $this->getModelNameFromType(request('type'));
        $commnet = Comment::firstOrCreate([
            'commnetable_id' => request('model'),
            'commentable_type' => $model,
            'user_id' => Auth::guard('api')->user()->id,
            'body' => request('body')
        ]);
//        return response()->json([]);
        return $commnet;
    }
    public function getModelNameFromType($type)
    {
        return $type === 'question'? 'App\Question':'App\Answer';
    }
}
