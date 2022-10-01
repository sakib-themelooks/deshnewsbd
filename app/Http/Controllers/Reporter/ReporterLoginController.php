<?php

namespace App\Http\Controllers\Reporter;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\SendOtp;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Notification;

class ReporterLoginController extends Controller
{

    public function __construct()
    {
      $this->middleware('guest:reporter', ['except' => ['logout']]);
    }

    public function loginForm() {
      return view('reporter.login');
    }

    public function validateReporterLogin(Request $request) {
        $this->validate($request, [
            'emailOrMobile' => 'required',
            'password' => 'required',
        ]);

        $fieldType = filter_var($request->emailOrMobile, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';

        if($fieldType == 'email'){
          $user = User::where('email',$request['emailOrMobile'])
                  ->where('role_id','=','reporter')
                  ->first();
          if($user!=null && Hash::check($request['password'], $user->password)){
            return response()->json([
                'success'=>true,
                'mobile' => $user->mobile
            ]);
          }
        }
        else{
          $user = User::where('mobile',$request['emailOrMobile'])
                  ->where('role_id','=','reporter')
                  ->first();
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

    public function sendReporterEmailOtp(Request $request)
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

    public function verifyReporterEmailOtp(Request $request)
    {
      $this->validate($request, [
            'emailOrMobile' => 'required',
            'password' => 'required',
            'code' => 'required',
        ]);

        $emailOrMobile = trim($request->emailOrMobile);
        $password = trim($request->password);
        //remember credentials
        Cookie::queue('reporterEmailOrMobile', $emailOrMobile, time() + (86400));
        Cookie::queue('reporterPassword', $password, time() + (86400));

        $fieldType = filter_var($request->emailOrMobile, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
      
      $user = null;  

      if($fieldType == 'email'){
          $user = User::where('email',$request['emailOrMobile'])->where('role_id','reporter')->first();
      }
      else{
          $user = User::where('mobile',$request['emailOrMobile'])->where('role_id','reporter')->first();
      }
      
      if($user!=null && Auth::guard('reporter')->attempt(array($fieldType => $emailOrMobile, 'password' => $password, 'role_id' => 'reporter')))
      {
          if (Auth::guard('reporter')->user()->status != 'active') {
              Auth::guard('reporter')->logout();
              Toastr::error('Your reporter request is pending review by our team before being activated.');
              return response()->json([
                  'success'=>false,
                  'message' => "Unable to login"
              ],500);
          }
          Toastr::success('Logged in success.');
          return response()->json([
              'success'=>true,
          ]);
      }
      else {
        Toastr::error( $fieldType. ' or password is invalid.');
        return response()->json([
            'success'=>false,
            'message' => "Unable to login"
        ],500);
      }
    }

    public function login(Request $request) {
      $this->validate($request, [
            'emailOrMobile' => 'required',
            'password' => 'required',
        ]);

        $emailOrMobile = trim($request->emailOrMobile);
        $password = trim($request->password);
        //remember credentials
        Cookie::queue('reporterEmailOrMobile', $emailOrMobile, time() + (86400));
        Cookie::queue('reporterPassword', $password, time() + (86400));

        $fieldType = filter_var($request->emailOrMobile, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';

      if(Auth::guard('reporter')->attempt(array($fieldType => $emailOrMobile, 'password' => $password, 'role_id' => 'reporter')))
      {
          if (Auth::guard('reporter')->user()->status != 'active') {
              Auth::guard('reporter')->logout();
              Toastr::error('Your reporter request is pending review by our team before being activated.');
              return response()->json([
                  'success'=>false,
                  'message' => "Unable to login"
              ],500);
          }
          Toastr::success('Logged in success.');
          return response()->json([
              'success'=>true,
          ]);
      }
      else {
        Toastr::error( $fieldType. ' or password is invalid.');
        return response()->json([
            'success'=>false,
            'message' => "Unable to login"
        ],500);
      }
    }

    public function logout() {
      Auth::guard('reporter')->logout();
      Toastr::success('Just Logged Out!');
      return redirect()->route('reporterLogin');
    }
}
