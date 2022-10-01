<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use App\Models\PollQuestionAns;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PollingController extends Controller
{
    //poll lists
    public function pollings(){
        $polls = Poll::with(['pollOptions'])->where('status', 1)->whereDate('start_date', '<=', Carbon::now())->get();
        return view('frontend.polls')->with(compact('polls'));
    }

    public function poll_details($slug){
        $poll = Poll::with(['pollOptions'])->where('slug', $slug)->where('status', 1)->whereDate('start_date', '<=', Carbon::now())->first();
        return view('frontend.poll_details')->with(compact('poll'));
    }


    //poll count
    public function userPolling(Request $request){

        $poll =  PollQuestionAns::where('id', $request->pollOption)->where('poll_id',$request->poll_id)->first();
        if($poll){
            $poll->increment('votes');
            $output = [
                'status' => true,
                'msg' => 'Polling success'
            ];
        }else{
            $output = [
                'status' => false,
                'msg' => 'Polling failed'
            ];
        }
        return response()->json($output);
    }

}
