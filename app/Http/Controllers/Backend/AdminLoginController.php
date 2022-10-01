<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SendOtp;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;

class AdminLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:admin', ['except' => ['logout']]);
    }

 	public function LoginForm()
    {
      return view('backend.login');
    }

  public function validateLoginCredentials(Request $request)
    {
        // Validate the form data
        $this->validate($request,[
        'emailOrMobile' => 'required',
        'password' => 'required',
        ]);

        $fieldType = filter_var($request->emailOrMobile, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        
        if($fieldType == 'email'){
          $user = User::where('email',$request['emailOrMobile'])->first();
          if($user!=null && Hash::check($request['password'], $user->password)){
            return response()->json([
                'success'=>true,
                'mobile' => $user->mobile
            ]);
          }
        }
        else{
          $user = User::where('mobile',$request['emailOrMobile'])->first();
          
          if($user!=null && Hash::check($request['password'], $user->password)){
            return response()->json([
                'success'=>true,
                'mobile' => $user->mobile
            ]);
          }
        }

        return response()->json([
            'success'=>false,
            'message' => "Invalid login credentials"
        ],500);
    }

  public function sendEmailOtp(Request $request)
  {
        // Validate the form data
        $this->validate($request,[
        'emailOrMobile' => 'required'
        ]);

        $fieldType = filter_var($request->emailOrMobile, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        
        if($fieldType == 'email'){
          $user = User::where('email',$request['emailOrMobile'])->first();
          if($user!=null){            
            $otp = rand(100000,999999);
            $user->otp = $otp;
            $user->update();

            Notification::send($user, new SendOtp($user));

            return response()->json([
                'success'=>true,
                'mobile' => $user->mobile
            ]);
          }
        }
        else{
          $user = User::where('mobile',$request['emailOrMobile'])->first();
          if($user!=null){
            $otp = rand(100000,999999);
            $user->otp = $otp;
            $user->update();
            
            Notification::send($user, new SendOtp($user));
            return response()->json([
                'success'=>true,
                'mobile' => $user->mobile
            ]);
          }
        }

        return response()->json([
            'success'=>false,
            'message' => "Unable to end emaiil"
        ],500);
  }  

    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request,[
          'emailOrMobile' => 'required',
          'password' => 'required',
        ]);

        $fieldType = filter_var($request->emailOrMobile, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
        // Attempt to log the admin in
        if(Auth::guard('admin')->attempt(array($fieldType => $request->emailOrMobile, 'password' => $request->password, 'role_id' => ['admin','user'], 'status' => 'active')))
        {
            Toastr::success('Logged in success.');
            return response()->json([
                'success'=>true,
            ]);
        }
        else {
            return response()->json([
                'success'=>false,
                'message' => "Invalid login credentials"
            ],500);
        }
    }

  public function verifyEmailOtp(Request $request)
  {
    // Validate the form data
        $this->validate($request,[
          'code' => 'required',
          'emailOrMobile' => 'required',
          'password' => 'required',
        ]);

        $fieldType = filter_var($request->emailOrMobile, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';


        if($fieldType == 'email'){
          $user = User::where('email',$request['emailOrMobile'])
                  ->where('otp',$request['code'])
                  ->first();
          if($user!=null){            
            if(Auth::guard('admin')->attempt(array($fieldType => $request->emailOrMobile, 'password' => $request->password, 'role_id' => ['admin','user'], 'status' => 'active')))
            {
                Toastr::success('Logged in success.');
                return response()->json([
                    'success'=>true,
                ]);
            }
          }
        }
        else{
          $user = User::where('mobile',$request['emailOrMobile'])
                  ->where('otp',$request['otp'])
                  ->first();
          if($user!=null){            
            if(Auth::guard('admin')->attempt(array($fieldType => $request->emailOrMobile, 'password' => $request->password, 'role_id' => ['admin','user'], 'status' => 'active')))
            {
                Toastr::success('Logged in success.');
                return response()->json([
                    'success'=>true,
                ]);
            }
          }
        }
        
        return response()->json([
            'success'=>false,
            'message' => "Invalid login credentials"
        ],500);
  }  

  public function logout()
  {
      Auth::guard('admin')->logout();
      Toastr::success('Just Logged Out!');
      return redirect()->route('adminLoginForm');
    }
  }
