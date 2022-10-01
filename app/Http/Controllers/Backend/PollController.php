<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\Poll;
use App\Models\PollQuestionAns;
use App\Traits\CreateSlug;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
class PollController extends Controller
{
    use CreateSlug;
    public function list()
    {
        $data['polls'] = Poll::all();
        return view('backend.poll.index')->with($data);
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();
        $poll = new Poll();
        $poll->user_id = $user_id;
        $poll->question_title = $request->question_title;
        $poll->slug = $this->createSlug('polls', $request->question_title);
        $poll->poll_details = $request->poll_details;
        $poll->start_date = $request->start_date;
        $poll->end_date = $request->end_date;
        $poll->bg_color = $request->bg_color;
        $poll->text_color = $request->text_color;
        $poll->login_status = ($request->login_status) ? 1 : 0;
        $poll->status = ($request->status) ? 1 : 0;
        $store = $poll->save();
        if($store){
            if(!empty($request->options)){
                $pollOption = [];
                foreach($request->options as $option){
                    if($option) {
                        $pollOption[] = ['poll_id' => $poll->id, 'option' => $option ];
                    }
                }
                if ( !empty(array_filter($pollOption))) {
                    PollQuestionAns::insert($pollOption);
                }
            }
            Toastr::success('Poll created success.', 'success');
        }else{
             Toastr::error('Poll create failed!.', 'error');
        }

        return back();
    }

    public function edit($poll_id)
    {
        $poll = Poll::with('pollOptions')->where('id', $poll_id)->first();
        return view('backend.poll.edit')->with(compact('poll'));
    }

    public function update(Request $request)
    {
        $user_id = Auth::id();
        $poll = Poll::find($request->id);
        $poll->question_title = $request->question_title;
        $poll->poll_details = $request->poll_details;
        $poll->start_date = $request->start_date;
        $poll->end_date = $request->end_date;
        $poll->bg_color = $request->bg_color;
        $poll->text_color = $request->text_color;
        $poll->login_status = ($request->login_status) ? 1 : 0;
        $poll->status = ($request->status) ? 1 : 0;
        $update = $poll->save();

        if($update){
            //update option
            if(!empty($request->editoptions)){
                $pollOption = $ids = [];
                foreach($request->editoptions as $id => $option){
                    if($option) {
                        $ids[] = $id;
                        $pollOption[] = ['id' => $id, 'poll_id' => $poll->id, 'option' => $option ];
                    }
                }

                if ( !empty(array_filter($pollOption))) {
                    PollQuestionAns::upsert($pollOption, ['id']);
                }
            }
            //insert new option
            if(!empty($request->options)){
                $pollOption = [];
                foreach($request->options as $option){
                    if($option) {
                        $pollOption[] = ['poll_id' => $poll->id, 'option' => $option ];
                    }
                }
                if ( !empty(array_filter($pollOption))) {
                    PollQuestionAns::insert($pollOption);
                }
            }
            Toastr::success('Poll update success.', 'success');
        }else{
            Toastr::error('Poll update failed!.', 'error');
        }

        return back();
    }
    // delete
    public function delete($id)
    {
        $delete =  Poll::find($id);
        if($delete){
            $delete->delete();
            $output = [
                'status' => true,
                'msg' => 'Poll delete successfull.'
            ];

        }else{
            $output = [
                'status' => false,
                'msg' => 'Sorry poll can\'t deleted.'
            ];
        }
        return response()->json($output);
    }
    // delete poll option
    public function pollOptionDelete($id)
    {
        $delete =  PollQuestionAns::find($id);
        if($delete){
            $delete->delete();
            $output = [
                'status' => true,
                'msg' => 'Poll option delete successfull.'
            ];

        }else{
            $output = [
                'status' => false,
                'msg' => 'Sorry poll option can\'t deleted.'
            ];
        }
        return response()->json($output);
    }
    //poll result
    public function pollResult($poll_id){
        $results =  PollQuestionAns::where('poll_id',$poll_id)->get();
        if($results){
            return view('backend.poll.result')->with(compact('results'));
        }else{
            return '<p style="color:red">Poll Option not set.!</p>';
        }
    }

}
