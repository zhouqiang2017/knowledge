<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Notifications\DatabaseNotification;

class NotificationsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('notifications.index', compact('user'));
    }
    public function show(DatabaseNotification $notification)
    {
        $notification->markAsRead();
        return redirect(\Request::query('redirect_uri'));
    }
}
