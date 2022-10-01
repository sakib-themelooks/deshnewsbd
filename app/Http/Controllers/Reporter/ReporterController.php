<?php

namespace App\Http\Controllers\Reporter;

use App\Http\Controllers\Controller;

use App\Models\Deshjure;
use App\Models\News;
use App\Models\Reporter;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use App\Traits\CreateSlug;

class ReporterController extends Controller
{
    use CreateSlug;
    public function dashboard(){
    	$user_id = Auth::guard('reporter')->id();
        $data['pending_news'] = News::where('user_id', $user_id)->where('status', 'pending')->count();
        $data['news'] = News::where('user_id', $user_id)->count();
        $data['popularNews'] = News::join('users', 'news.user_id', '=', 'users.id')
            ->leftJoin('categories', 'news.category', '=', 'categories.id')
            
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->where('news.user_id', $user_id)->selectRaw('news.*, users.name, users.username,categories.category_bd,categories.category_en,media_galleries.source_path')
            ->groupBy('news.id')->orderBy('view_counts', 'desc')->take(5)->get();
        $data['recentNewses'] = News::join('users', 'news.user_id', '=', 'users.id')
            ->leftJoin('categories', 'news.category', '=', 'categories.id')
            
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->where('news.user_id', $user_id)
            ->groupBy('news.id')->selectRaw('news.*, users.name, users.username,categories.category_bd,categories.category_en,media_galleries.source_path')->orderBy('news.id', 'desc')->take(5)->get();

        return view('reporter.dashboard')->with($data);
    }

    public function profileEdit()
    {
        $data = [];
        $reporter_id = Auth::guard('reporter')->id();
        $data['reporter'] = User::with('userinfo')->where('id', $reporter_id)->first();
        $data['states'] = Deshjure::where('cat_type', 1)->get();
        $data['present_upazilas'] = Deshjure::where('parent_id', $data['reporter']->userinfo->present_zilla)->get();
        $data['permanent_upazilas'] = Deshjure::where('parent_id', $data['reporter']->userinfo->permanent_zilla)->get();
        $data['working_upazilas'] = Deshjure::where('parent_id', $data['reporter']->userinfo->working_zilla)->get();
        if ($data['reporter']) {
            return view('reporter.editProfile')->with($data);
        } else {
            Toastr::error('Sorry invalid reporter try again!.');
            return back();
        }
    }

    public function profileUpdate(Request $request)
    {
        Session::put('present_zilla', $request->present_zilla);
        Session::put('permanent_zilla', $request->permanent_zilla);
        Session::put('working_zilla', $request->working_zilla);

        $reporter_id = Auth::guard('reporter')->id();
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'national_id' => 'required',
            'working_zilla' => 'required',
            'working_upazila' => 'required',
            'mobile' => ['required','min:11','regex:/(01)[0-9]/','unique:users,mobile,'.$reporter_id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$reporter_id],
        ]);

        $mobile = trim($request->mobile);
        $email = trim($request->email);
        $password = trim($request['password']);

        $user = User::find($reporter_id);
        $user->name = $request->name;
        $user->lname = $request->lname;
        $user->email = $email;
        $user->mobile = $mobile;
        $user->gender = $request->gender;
        $user->blood = $request->blood;
        $user->birthday = $request->birthday;

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
            $reporter->present_zilla = $request->present_zilla;
            $reporter->present_upazila = $request->present_upazila;
            $reporter->permanent_address = $request->permanent_address;
            $reporter->permanent_zilla = $request->permanent_zilla;
            $reporter->permanent_upazila = $request->permanent_upazila;
            $reporter->working_zilla = $request->working_zilla;
            $reporter->working_upazila = $request->working_upazila;
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
            Toastr::success('Profile update success.');
            return redirect()->back();
        }else{
            Toastr::error('Profile update failed try again.');
            return back()->withInput();
        }

    }

    //change profile image
    public function changeProfileImage(Request $request){
        $this->validate($request, [
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);
        $user = User::find(Auth::guard('reporter')->id());
        //if photo set
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $new_image_name = $this->uniquePath('users', 'photo', $image->getClientOriginalName());
            $image_path = public_path('upload/images/users/' . $new_image_name);
            $image_resize = Image::make($image);
            $image_resize->resize(200, 200);
            $image_resize->save($image_path);
            $user->photo = $new_image_name;
            $user->save();
        }
        Toastr::success('Your profile image update success.');
        return back();
    }
    //change Password
    public function passwordChange(Request $request){
        return view('reporter.change-password');
    }

    //password update
    public function passwordUpdate(Request $request){

        $reporter_id  = Auth::guard('reporter')->id();
        $check = User::find($reporter_id);
        if($check) {
            $this->validate($request, [
                'old_password' => 'required',
                'password' => 'required|confirmed:min:6'
            ]);

            $old_password = $check->password;
            if (Hash::check($request->old_password, $old_password)) {
                if (!Hash::check($request->password, $old_password)) {
                    $user = User::find($reporter_id);
                    $user->password = Hash::make($request->password);
                    $user->save();
                    Toastr::success('Password successfully change.', 'Success');
                    return redirect()->back();
                } else {
                    Toastr::error('New password cannot be the same as old password.', 'Error');
                    return redirect()->back();
                }
            } else {
                Toastr::error('Old password not match', 'Error');
                return redirect()->back();
            }
        }else{
            Toastr::error('Sorry your password can\'t change.', 'Error');
            return redirect()->back();
        }
    }
}
