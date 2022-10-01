<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\News;
use App\User;
use App\Models\Reporter;
use Auth;
use Redirect;
class DashboardController extends Controller
{

    public function dashboard(){
    	$data['reporters'] = Reporter::count();
    	$data['pending_news'] = News::where('status', 'pending')->count();
    	$data['news'] = News::count();
    	$data['category'] = Category::count();
    	$data['user'] = User::where('role_id', 'user')->count();
        $data['withdraws'] = Transaction::where('type', 'withdraw')->where('status', 'pending')->count();
        $data['comment'] = Comment::where('type', 1)->count();

    	return view('backend.dashboard')->with($data);


    }
}
