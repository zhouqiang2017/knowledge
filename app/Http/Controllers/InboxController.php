<?php

namespace App\Http\Controllers;

use App\Message;
use Auth;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $messages = Message::where('to_user_id', user()->id)
            ->orWhere('from_user_id', user()->id)
            ->with(['fromUser', 'toUser'])->get();
        return view('inbox.index',['messages' => $messages->unique('dialog_id')->groupBy('to_user_id')]);
    }

    public function show($dialogId)
    {
        $messages = Message::where('dialog_id', $dialogId)->latest()->get();
        return view('inbox.show',compact('messages','dialogId'));
    }
    public function store($dialogId)
    {
        $messages = Message::where('dialog_id', $dialogId)->first();
        $toUserId = $messages->from_user_id === user()->id ? $messages->to_user_id : $messages->from_user_id;
        Message::create([
            'from_user_id' => user()->id,
            'to_user_id'   => $toUserId,
            'body'         => request('body'),
            'dialog_id'    => $dialogId
        ]);
        return back();
    }
}
