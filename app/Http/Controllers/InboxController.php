<?php

namespace App\Http\Controllers;

use App\Notifications\NewMessageNotification;
use App\Repositories\MessageRepository;
use Auth;
use Illuminate\Http\Request;

/**
 * Class InboxController
 *
 * @package App\Http\Controllers
 */
class InboxController extends Controller
{
    /**
     * @var \App\Repositories\MessageRepository
     */
    protected $message;

    /**
     * InboxController constructor.
     *
     * @param \App\Repositories\MessageRepository $message
     */
    public function __construct(MessageRepository $message)
    {
        $this->middleware('auth');
        $this->message = $message;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $messages = $this->message->getAllMessages();
        return view('inbox.index', ['messages' => $messages->unique('dialog_id')->groupBy('to_user_id')]);
    }

    /**
     * @param $dialogId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($dialogId)
    {
        $messages = $this->message->getDialogMessages($dialogId);
        $messages->markAsRead();
        return view('inbox.show', compact('messages', 'dialogId'));
    }

    /**
     * @param $dialogId
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($dialogId)
    {
        $messages = $this->message->getSingleDialogMessages($dialogId);
        $toUserId = $messages->from_user_id === user()->id ? $messages->to_user_id : $messages->from_user_id;
        $newMessage = $this->message->create([
            'from_user_id' => user()->id,
            'to_user_id' => $toUserId,
            'body' => request('body'),
            'dialog_id' => $dialogId
        ]);
        $newMessage->toUser->notify(new NewMessageNotification($newMessage));
        return back();
    }
}
