<?php

namespace App\Http\Controllers\Activate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
class NotificationController extends Controller
{
    public function index()
    {
        $notification =\Auth::user()->unreadNotifications;
       return Notification::all();
    }
    public function read(Request $request)
    {   
       \Auth::user()->unreadNotifications()->find($request->id)->MarkAsRead();
       return 'success';
    }
}
