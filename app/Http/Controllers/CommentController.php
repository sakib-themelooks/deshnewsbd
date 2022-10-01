<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use App\Models\Notification;
use App\User;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Traits\CreateSlug;

class CommentController extends Controller
{
    use CreateSlug;

    public function comment_insert(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = [
            'news_id' => $request->news_id,
            'user_id' => $user_id,
            'comments' => $request->comment,
            'type' => 1,
        ];

        $comment = Comment::updateOrCreate(['user_id' => Auth::user()->id, 'id' => $request->id], $data);

        if($comment){
            $author = News::find($request->news_id);
            if($author->user_id != $user_id){
                $notify = [
                    'fromUser' => $user_id,
                    'toUser' => $author->user_id,
                    'type' => env('COMMENT'),
                    'item_id' => $comment->id,
                    'notify' => 'comment on your news',
                ];
                Notification::create($notify);
            }
            if(!$request->id){
                   echo view('frontend.comment.show_comment')->with(compact('comment'));
            }else{
                echo $request->comment;
            }
        }
    }

    public function registrationAndComment(Request $request)
    {
       
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobile_or_email' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $email = $phone = null;
        if (filter_var($request['mobile_or_email'], FILTER_VALIDATE_EMAIL)) {
            $email = $request['mobile_or_email'];
            $check = User::select('username')->where('email', $email)->first();
            $msg = 'Sorry email already exists.';
        }else{
            $phone = $request['mobile_or_email'];

            if(!is_numeric($phone) OR strlen($phone)<10){

                Toastr::error('Invalid mobile number or email.');
                return back();
            }

            $check = User::select('username')->where('phone', $phone)->first();
            $msg = 'Sorry mobile number already exists.';
        }

        if($check){
            Toastr::error($msg);
            return back();
            exit();
        }
        $success = User::create([
            'name' => $request['name'],
            'username' => $this->createSlug('users', $request['name'], 'username'),
            'email' => $email,
            'mobile' => $phone,
            'role_id' => 'user',
            'created_by' => 0,
            'password' => Hash::make($request['password']),
            'status' => '1',
        ]);

        if($success){
            $fieldType = filter_var($request->emailOrMobile, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
            if(Auth::attempt([$fieldType => $request['mobile_or_email'], 'password' => $request->password])) {

                $user_id = Auth::user()->id;
                $data = [
                    'news_id' =>$request->news_id,
                    'user_id' => $user_id,
                    'comments' =>$request->comment,
                    'type' => 1,
                ];
                $insert = Comment::create($data);
                if($insert){
                    $author = News::find($request->news_id);
                    $notify = [
                        'fromUser' => $user_id,
                        'toUser' => $author->user_id,
                        'type' => env('COMMENT'),                      
                        'item_id' => $insert->id,
                        'notify' => 'comment on your news',
                    ];
                }
            }

            Toastr::success('মন্তব্য সফলভাবে পোস্ট হয়েছে');
            return back();
        }else{
            Toastr::error('দুঃখিত রেজিস্ট্রেশন ব্যর্থ হয়েছে।');
            return back();
        }

    }

    public function comment_reply(Request $request, $comment_id)
    {


        $request->validate([
            'reply_comment' => ['required']
        ]);


        $user_id = Auth::user()->id;

        if($request->reply_id){
            Comment::where('user_id', Auth::user()->id)->where('id', $request->reply_id)->update(['comments' => $request->reply_comment]);
            echo $request->reply_comment;
        }else{

            $data = [
                'news_id' => $request->news_id,
                'user_id' => $user_id,
                'comments' => $request->reply_comment,
                'comment_id' => $comment_id,
                'type' => 2,
            ];

            $replyComment = Comment::create($data);

            if($replyComment){
                $toUser = Comment::find($comment_id);
                // check comment author reply
                if($toUser->user_id !=$user_id){
                    $notify = [
                        'fromUser' => $user_id,
                        'toUser' => $toUser->user_id,
                        'type' => env('COMMENT'),
                        'item_id' => $replyComment->id,
                        'notify' => 'reply on your comment',
                    ];
                    Notification::create($notify);
                }
                echo view('frontend.comment.show_reply_comment')->with(compact('replyComment'));
                
            }
        }
    }

    public function comment_reply_update(Request $request, $comment_id)
    {

        $request->validate([
            'reply_comment' => ['required']
        ]);


        $user_id = Auth::user()->id;
        $data = [
            'news_id' => $request->news_id,
            'user_id' => $user_id,
            'comments' => $request->reply_comment,
            'comment_id' => $comment_id,
            'type' => 2,
        ];

        $replyComment = Comment::updateOrCreate(['news_id' => $request->news_id, 'user_id' => Auth::user()->id, 'id' => $request->id], $data);

        if($replyComment){
            $toUser = Comment::find($comment_id);
            $notify = [
                'fromUser' => $user_id,
                'toUser' => $toUser->user_id,
                'type' => env('REPORTER_NOTIFY'),
                'item_id' => $request->news_id,
                'notify' => 'reply on your comment',
            ];
            Notification::create($notify);

            if(!$request->update){
                echo view('frontend.comment.show_reply_comment')->with(compact('replyComment'));
            }else{
                echo $request->reply_comment;
            }
        }
    }

    public function comments($slug){
        $data['get_news'] = News::where('news_slug', $slug)->first();
        if($data['get_news']){
            $data['comments'] = Comment::where('news_id', $data['get_news']->id)->where('type', 1)->paginate(25);

            $data['more_news'] =News::with(['categoryList', 'subcategoryList', 'image'])
                ->where('news.id', '!=', $data['get_news']->id)
                ->where('news.category', $data['get_news']->category)
                ->orderBy('id', 'DESC')
                ->take(8)->get();
            return view('frontend.comment.news-comments')->with($data);
        }else{
            return view('frontend.404');
        }

    }

    public function commentDelete(Request $request){
       
        $delete = Comment::where(function($query){
            if(Auth::user()->role_id != env('ADMIN')){
                $query->where('user_id', Auth::user()->id);
            }
        })->where('id', $request->com_id)->first();
        if($delete){
            Comment::where('comment_id', $request->com_id)->delete();
            Notification::where('item_id', $delete->id)->where('fromUser', $delete->user_id)->delete();
            $delete->delete();
            $output = array(
             'status' => 'success',
             'msg'  => 'Comment deleted'
            );
        }else{
            $output = array(
             'status' => 'error',
             'msg'  => 'Sorry something is wrong try again.'
            );
        }
        
        return response()->json($output);
    }


}
