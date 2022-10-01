<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function notifications()
    {
        $user_id = Auth::user()->id;
        $notifications = Notification::where('toUser', $user_id)->paginate(20);
        if(count($notifications)>0) {
            return view('frontend.notifications')->with(compact('notifications'));
        }else{
            return view('frontend.404');
        }
    }

    public function readNotify($id)
    {
        $user_id = Auth::guard('reporter')->user()->id;
        Notification::where('toUser', $user_id)->where('id', $id)->update(['read' => 1]);
    }
}
