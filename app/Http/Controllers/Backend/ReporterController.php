<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Deshjure;
use App\Models\News;
use App\Models\Notification;
use App\Models\Reporter;

use App\Models\Transaction;
use App\Traits\CreateSlug;
use App\Traits\Sms;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class ReporterController extends Controller
{
    use CreateSlug;
    use Sms;
    public function index(Request $request, $status= '')
    {
        $reporters = User::withCount('allnews')
            ->where('role_id', 'reporter')
            ->join('reporters', 'users.id', 'reporters.user_id');
        if($status){
            $reporters->where('users.status', $status);
        }
        if(!$status && $request->status && $request->status != 'all'){
            $reporters->where('users.status', $request->status);
        }
        if($request->reporter && $request->reporter != 'all'){
        $keyword = $request->reporter;
        $reporters->where(function ($query) use ($keyword) {
                $query->orWhere('name', 'like', '%' . $keyword . '%');
                $query->orWhere('mobile', 'like', '%' . $keyword . '%');
                $query->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }if($request->location && $request->location != 'all'){
            $reporters->where('working_zilla', $request->location);
        }
        $perPage = 15;
            if($request->show){
                $perPage = $request->show;
            }

        $data['reporters'] = $reporters->orderBy('reporters.position', 'ASC')->selectRaw('users.*, reporters.designation, reporters.id as reporter_id')->paginate($perPage);
       
        $data['locations'] = Deshjure::where('cat_type', 1)->get();

        return view('backend.reporter.reporter-list')->with($data);
    }

    public function reporterProfile($username){
        $data['reporter']  = User::where('username', $username)->first();
        $data['get_news'] = News::orderBy('news.id', 'desc')
            ->join('users', 'news.user_id', '=', 'users.id')
            ->leftJoin('categories', 'news.category', '=', 'categories.id')
           
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->where('news.user_id', $data['reporter']->id)
            ->groupBy('news.id')->selectRaw('news.*, users.name, users.username,categories.category_bd,categories.category_en,media_galleries.source_path')->paginate(15);
        $data['transactions'] = Transaction::with(['user:id,name,username,mobile', 'addedBy'])
            ->where('user_id', $data['reporter']->id)
            ->whereIn('type', ['wallet', 'withdraw'])
            ->orderBy('id', 'desc')->paginate(15);
        return view('backend.reporter.profile')->with($data);
    }
    public function create()
    {
        $data['states'] = Deshjure::where('cat_type', 1)->get();
        return view('backend.reporter.reporter')->with($data);
    }

    public function store(Request $request)
    {
        Session::put('present_zilla', $request->present_zilla);
        Session::put('permanent_zilla', $request->permanent_zilla);
        Session::put('working_zilla', $request->working_zilla);
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'required|confirmed|min:6'
        ]);

        $mobile = trim($request->mobile);
        $email = trim($request->email);
        $password = trim($request['password']);
        $username = explode(' ', trim($request->name))[0];
        $username = $this->createSlug('users', $username, 'username');
        $username = trim($username, '-');

        $user = new User;
        $user->name = $request->name;
        $user->username = $this->createSlug('users', $username, 'username');
        $user->email = $email;
        $user->mobile = $mobile;
        $user->gender = $request->gender;
        $user->blood = $request->blood;
        $user->birthday = $request->birthday;
        $user->password = Hash::make($password);
        $user->updated_at = Carbon::now()->addHours(1);
        //if photo set
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $new_image_name = $this->uniquePath('users', 'photo', $image->getClientOriginalName());
            $image_path = public_path('upload/images/users/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(200, 200);
            $image_resize->save($image_path);
            $user->photo = $new_image_name;
        }
        $user->role_id = 'reporter';
        $user->status = ($request->request) ? 'active' : 'pending';
        $success = $user->save();
        if($success) {
            $reporter = new Reporter();
            $reporter->user_id = $user->id;
            $reporter->profession = $request->profession;
            $reporter->father_name = $request->father_name;
            $reporter->mother_name = $request->mother_name;
            $reporter->present_address = $request->present_address;
            $reporter->permanent_address = $request->permanent_address;
            $reporter->emg_contact_name = $request->emg_contact_name;
            $reporter->emg_contact_phone = $request->emg_contact_phone;
            $reporter->emg_contact_rel = $request->emg_contact_rel;
            $reporter->emg_contact_address = $request->emg_contact_address;
            $reporter->national_id = $request->national_id;
            //if photo set
            if ($request->hasFile('national_attach')) {
                $national_attach = $request->file('national_attach');
                $new_name = $this->uniquePath('reporters', 'national_attach', $national_attach->getClientOriginalName());
                $national_attach->move(public_path('upload/attach'), $new_name);
                $reporter->national_attach = $new_name;
            }

            //if photo set
            if ($request->hasFile('resume')) {
                $resume = $request->file('resume');
                $new_name = $this->uniquePath('reporters', 'resume', $resume->getClientOriginalName());
                $resume->move(public_path('upload/attach/resume'), $new_name);
                $reporter->resume = $new_name;
            }
            $reporter->status = 'active';
            $reporter->save();

            Toastr::success('Registration in success.');

            $msg = 'Hello '.$mobile.', Thank you for registering with '.$_SERVER['SERVER_NAME'].'.';
            $this->sendSms($mobile, $msg);
            return redirect()->back();
        }else{
            Toastr::error('Registration failed try again.');
            return back()->withInput();
        }
    }

    public function edit($id)
    {

        $data = [];
        $data['reporter'] = User::with('userinfo')->where('id', $id)->first();
        $data['states'] = Deshjure::where('cat_type', 1)->get();
        $data['present_upazillas'] = Deshjure::where('parent_id', $data['reporter']->userinfo->present_zilla)->get();
        $data['permanent_upazillas'] = Deshjure::where('parent_id', $data['reporter']->userinfo->permanent_zilla)->get();
        $data['working_upazillas'] = Deshjure::where('parent_id', $data['reporter']->userinfo->working_zilla)->get();
        if($data['reporter']){
            return view('backend.reporter.reporter-edit')->with($data);
        }else{
            Toastr::error('Sorry invalid user try again!.');
            return back();
        }
    }

    public function update(Request $request, $reporter_id)
    {
        Session::put('present_zilla', $request->present_zilla);
        Session::put('permanent_zilla', $request->permanent_zilla);
        Session::put('working_zilla', $request->working_zilla);
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $mobile = trim($request->mobile);
        $email = trim($request->email);
        $password = trim($request['password']);

        $user = User::find($reporter_id);
        $user->name = $request->name;
       
        $user->email = $email;
        $user->mobile = $mobile;
        $user->gender = $request->gender;
        $user->blood = $request->blood;
        $user->birthday = $request->birthday;
        if($request->password) {
            $user->password = Hash::make($password);
        }
        //if photo set
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $new_image_name = $this->uniquePath('users', 'photo', $image->getClientOriginalName());
            $image_path = public_path('upload/images/users/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(200, 200);
            $image_resize->save($image_path);
            $user->photo = $new_image_name;
        }

        $user->status = ($request->request) ? 'active' : 'pending';
        $success = $user->save();
        if($success) {
            $reporter = Reporter::where('user_id', $reporter_id)->first();
            $reporter->user_id = $user->id;
            $reporter->profession = $request->profession;
            $reporter->father_name = $request->father_name;
            $reporter->mother_name = $request->mother_name;
            $reporter->present_address = $request->present_address;
            $reporter->permanent_address = $request->permanent_address;
            $reporter->emg_contact_name = $request->emg_contact_name;
            $reporter->emg_contact_phone = $request->emg_contact_phone;
            $reporter->emg_contact_rel = $request->emg_contact_rel;
            $reporter->emg_contact_address = $request->emg_contact_address;
            $reporter->national_id = $request->national_id;
            //if photo set
            if ($request->hasFile('national_attach')) {
                $national_attach = $request->file('national_attach');
                $new_name = $this->uniquePath('reporters', 'national_attach', $national_attach->getClientOriginalName());
                $national_attach->move(public_path('upload/attach'), $new_name);
                $reporter->national_attach = $new_name;
            }

            //if photo set
            if ($request->hasFile('resume')) {
                $resume = $request->file('resume');
                $new_name = $this->uniquePath('reporters', 'resume', $resume->getClientOriginalName());
                $resume->move(public_path('upload/attach/resume'), $new_name);
                $reporter->resume = $new_name;
            }
            $reporter->save();
            Toastr::success('Registration update success.');
            return redirect()->back();
        }else{
            Toastr::error('Registration failed try again.');
            return back()->withInput();
        }
    }

    public  function delete($id){
        $check = User::find($id);
        if($check){
            // reporter from make user
            $delete = $check->update(['role_id' => 'user']);
            Reporter::where('user_id', $id)->delete();
            $notify = [
                'fromUser' => null,
                'toUser' => $check->id,
                'type' => env('REPORTER_NOTIFY'),
                'notify' => 'Reporter request rejected.',
            ];
            Notification::create($notify);

            $output = [
                'status' => true,
                'msg' => 'Reporter deleted successful.'
            ];

        }else{
            $output = [
                'status' => false,
                'msg' => 'Sorry reporter delete failed.'
            ];
        }
        return response()->json($output);
    }

    public function manage_request(){
        $get_reporter = Reporter::with('user')->where('status', 0)->get();
        return view('backend.reporter.reporter-request-list')->with(compact('get_reporter'));
    }

    public function reporterSecretLogin($id)
    {
        $reporter = User::findOrFail(decrypt($id));
        auth()->guard('reporter')->login($reporter, true);
        Toastr::success('Reporter panel login success');
        return redirect()->route('reporter.dashboard');
    }

}
