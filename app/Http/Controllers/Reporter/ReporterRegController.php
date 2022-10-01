<?php

namespace App\Http\Controllers\Reporter;

use App\Mail\EmailVerifyMail;
use App\Models\Deshjure;
use App\Models\Notification;
use App\Models\Reporter;
use App\Models\SiteSetting;
use App\Traits\CreateSlug;
use App\Traits\Sms;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ReporterRegController extends Controller
{
    use CreateSlug;
    use Sms;
    public function __construct()
    {
        $this->middleware('guest:reporter', ['except' => ['logout']]);
    }

    public function registerForm() {
        $data['states'] = Deshjure::where('cat_type', 1)->get();
        $data['user_details'] = [];
        if(Auth::check()){
            $data['user_details'] = User::where('id', Auth::id())->first();
        }
        return view('reporter.register')->with($data);
    }

    public function register(Request $request) {
        //check reporter registration active
        $gs = SiteSetting::where('type', 'reporter_registration')->first();
        if ($gs->status != 1) {
          Toastr::error('alert', 'Registration is closed by Admin');
          return back()->with('error', 'Registration is closed by Admin');
        }
      
        //check google robot reCaptcha
        $reCaptcha = SiteSetting::where('type', 'google_recaptcha')->first();
        if($reCaptcha->status == 1 && isset($_POST['g-recaptcha-response'])){
            $secretKey = $reCaptcha->secret_key;
            $captcha = $_POST['g-recaptcha-response'];
            if(!$captcha){
                Toastr::error('Please check the robot check.');
                return back()->withInput();
            }
            $ip = $_SERVER['REMOTE_ADDR'];
            $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
            $responseKeys = json_decode($response,true);
            if(intval($responseKeys["success"]) !== 1) {
                Toastr::error('Please check the robot check.');
                return back()->withInput();
            }
        }

        $request->validate([
            'name' => 'required',
            'mobile' => 'required|min:11|numeric|regex:/(01)[0-9]/|unique:users',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => 'required|confirmed|min:6'
        ]);

        $mobile = trim($request->mobile);
        $email = trim($request->email);
        $password = trim($request['password']);
        $username = explode(' ', trim($request->name))[0];
        $username = $this->createSlug('users', $username, 'username');
        $username = trim($username, '-');
        $code = rand(1111,9999);

        $user = new User;
        $user->name = $request->name;
        $user->username = $this->createSlug('users', $username, 'username');
        $user->email = $email;
        $user->mobile = $mobile;
        $user->gender = $request->gender;
        $user->blood = $request->blood;
        $user->birthday = $request->birthday;
        $user->mobile_verification_token = $code;
        $user->email_verification_token = Str::random(32);
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
        //user account verification sms
        $account_activation = SiteSetting::where('type', 'reporter_account_activation')->first();
        if($account_activation->status != 1 ) {
            $user->activation = 1;
        }
       
        $user->status = 'pending';
        $success = $user->save();
        if($success) {
            $reporter = new Reporter();
            $reporter->user_id = $user->id;
            $reporter->profession = $request->profession;
            $reporter->father_name = $request->father_name;
            $reporter->mother_name = $request->mother_name;
            $reporter->present_address = $request->present_address;
            $reporter->permanent_address = $request->permanent_address;
           
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
            //insert notification in database
            // Notification::create([
            //     'type' => 'register',
            //     'fromUser' => Auth::guard('reporter')->id(),
            //     'toUser' => null,
            //     'item_id' => Auth::guard('reporter')->id(),
            //     'notify' => 'register new reporter',
            // ]);
            Toastr::success('Registration in success.');

            if($account_activation->status == 1 ) {
                if ($mobile && $account_activation->value == 'sms') {
                    $msg = 'Thank you for registering with ' . $_SERVER['SERVER_NAME'] . '. Account verification code is: ' . $code;
                    $this->sendSms($mobile, $msg);
                    $url = route('userAccountVerify') . '?mobile=' . $mobile;
                    return redirect($url)->with('error', $user->name . ' your account is not activated. Please verify your mobile, verification code has been sent to your mobile.');
                }
                // if($email && $account_activation->value == 'email'){
                //     //send notification in email
                //     Mail::to($email)->send(new EmailVerifyMail($user));
                //     if (count(Mail::failures()) > 0) {
                //         return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
                //     } else {
                //         $url = route('userAccountVerify') . '?email=' . $email;
                //         return redirect($url)->with('error', $user->name . ' your account is not activated. Please verify your email, verification link has been sent to your email address.');
                //     }
                // }
            }else{
                if ($mobile) {
                    $msg = 'Thank you for registering with ' . $_SERVER['SERVER_NAME'];
                    $this->sendSms($mobile, $msg);
                }
            }

            return redirect()->route('reporterLogin')->with('success', 'Thanks your registration successfully complete.');

        }else{
            Toastr::error('Registration failed try again.');
            return back()->withInput();
        }
    }


}
