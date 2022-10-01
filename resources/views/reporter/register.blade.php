@extends('frontend.layouts.master')
@section('title', 'Reporter Register  | '.Config::get('siteSetting.site_name'))
@php  
    $reCaptcha = App\Models\SiteSetting::where('type', 'google_recaptcha')->first(); 
@endphp
@section('css')
    <link href="{{asset('backend/css/pages/login-register-lock.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
    @if($reCaptcha->status == 1)
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif
    <style type="text/css">
        @media (min-width: 1200px){
            .container {
                max-width: 1200px !important;
            }
        }
        .dropdown-toggle::after, .dropup .dropdown-toggle::after {
            content: initial !important;
        }
        .card-footer, .card-header {
            margin-bottom: 5px;
            border-bottom: 1px solid #ececec;
        }
        .dropify-wrapper{height: 150px;}
        .error{color:red;}
        .registerArea{background: #fff; color:#000; border-radius: 5px;margin:10px 0;padding: 10px !important ;}
        .registerArea h3{color: #0E96C6;}
       
    </style>
@endsection
@section('content')
<?PHP
$get_ads = App\Models\Addvertisement::where('page', 'user_profile')->where('status', 1)->get();
$top_head_right = $topOfNews = $middleOfNews = $bottomOfNews = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
foreach ($get_ads as $ads){
       if($ads->position == 2){
            $top_head_right = $ads->add_code;
        }elseif($ads->position == 3){
            $topOfNews = $ads->add_code;
        }elseif($ads->position == 4){
            $middleOfNews = $ads->add_code;
        }elseif($ads->position == 5){
            $bottomOfNews = $ads->add_code;
        }elseif($ads->position == 6){
            $sitebarTop = $ads->add_code;
        }elseif($ads->position == 7){
            $sitebarMiddle = $ads->add_code;
        }elseif($ads->position == 8){
            $sitebarBottom = $ads->add_code;
        }else{
            echo '';
        }
}
function banglaDate($date){
    return Carbon\Carbon::parse($date)->format('d F, Y');
}
?>

    <section style="background: #f7f7f7;">
    <div class="container">
        
        <div class="row justify-content-md-center" >
           
            <div class="col-md-2 col-12"></div>
            <div class="col-md-8 col-12 registerArea">
                <div class="card">
                    <h3 style="text-align: center;">Application For Reporter </h3>
                   <div class="card-body">
                        @if(Session::has('success'))
                        <div class="alert alert-success">
                          <strong>Success! </strong> {{Session::get('success')}}
                        </div>
                        @endif
                        @if(Session::has('error'))
                        <div class="alert alert-danger">
                          <strong>Error! </strong> {{Session::get('error')}}
                        </div>
                        @endif
                        <form data-parsley-validate action="{{route('reporterRegister')}}" enctype="multipart/form-data" id="regiterForm" method="post" >
                            @csrf
                            
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="control-label required" for="name">Full Name</label>
                                      <input type="text" required name="name" value="{{($user_details) ? $user_details->name : old('name')}}" placeholder="Enter Full Name" data-parsley-required-message = "Name is required" id="name" class="form-control">
                                        @if ($errors->has('name'))
                                            <span class="error" role="alert">
                                                {{ $errors->first('name') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label " for="mobile">Mobile Number</label>
                                      <input type="mobile" pattern="/(01)\d{9}/" onblur="checkField(this.value, 'mobile')" name="mobile" value="{{ ($user_details) ? $user_details->mobile : old('mobile')}}" onkeyup ="checkField(this.value, 'mobile')" placeholder="Enter Mobile Number" data-parsley-required-message = "Mobile number is required" class="form-control">
                                      <span id="mobile"></span>
                                        @if ($errors->has('mobile'))
                                            <span class="error" role="alert">
                                                {{ $errors->first('mobile') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label" for="email">Email Address</label>
                                      <input type="email" onblur="checkField(this.value, 'email')"  onkeyup ="checkField(this.value, 'email')" name="email" value="{{ ($user_details) ? $user_details->email : old('email')}}" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}" placeholder="Enter Email Address"  class="form-control">
                                      <span id="email"></span>
                                      @if ($errors->has('email'))
                                            <span class="error" role="alert">
                                                {{ $errors->first('email') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" for="gender">Gender</label>
                                        <select  name="gender" id="gender" class="form-control custom-select">
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ ($user_details && $user_details->gender =='male') ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ ($user_details && $user_details->gender =='female') ? 'selected' : '' }}>Female</option>
                                            <option value="others" {{ ($user_details && $user_details->gender =='others') ? 'selected' : '' }}>Others</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="" for="blood">Blood Group</label>
                                        <select name="blood"  id="blood" class="form-control custom-select">
                                            <option value="">Select Blood</option>
                                            <option @if( old('blood') == 'A+') selected @endif value="A+">A+</option>
                                            <option @if( old('blood') == 'A-') selected @endif value="A-">A-</option>
                                            <option @if( old('blood') == 'B+') selected @endif value="B+">B+</option>
                                            <option @if( old('blood') == 'B-') selected @endif value="B-">B-</option>
                                            <option @if( old('blood') == 'O+') selected @endif value="O+">O+</option>
                                            <option @if( old('blood') == 'O-') selected @endif value="O-">O-</option>
                                            <option @if( old('blood') == 'AB+') selected @endif value="AB+">AB+</option>
                                            <option @if( old('blood') == 'AB-') selected @endif value="AB-">AB-</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birthdate" class="control-label">Date of Birth</label>
                                        <input name="birthday" value="{{ ($user_details) ? $user_details->birthdate : old('birthday') }}"  id="birthdate" type="date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="profession">Current Profession</label>
                                        <input value="{{ ($user_details && $user_details->userinfo) ? $user_details->userinfo->profession : old('profession')}}" type="text" class="form-control @error('profession') is-invalid @enderror" name="profession" id="profession" placeholder="Enter profession">

                                        @error('profession')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Fathers">Father's Name</label>
                                        <input type="text" value="{{ ($user_details && $user_details->userinfo) ? $user_details->userinfo->father_name :  old('father_name') }}" placeholder="Enter father's name" name="father_name"  id="Fathers" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Mothers">Mother's Name</label>
                                        <input type="text"   value="{{  ($user_details && $user_details->userinfo) ? $user_details->userinfo->mother_name : old('mother_name') }}" name="mother_name" placeholder="Enter mother's name" id="Mothers" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="national_id" class="">NID/Passport/Driving Licence</label>
                                        <input value="{{ ($user_details && $user_details->userinfo) ? $user_details->userinfo->national_id : old('national_id')}}" type="text" class="form-control @error('national_id') is-invalid @enderror" placeholder="Enter NID/Passport/Driving Licence" name="national_id" id="national_id" autofocus>

                                        @error('national_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="">Upload NID/Passport/Driving Licence</label>
                                       
                                        <input type="file" name="national_attach" />
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label class="">Upload Your Recent Photo</label>
                                        
                                            <input type="file" accept="image/*" @if($user_details && $user_details->photo) data-default-file="{{asset('upload/images/users/thumb_image/'. $user_details->photo)}}" @else @endif  name="photo"  data-show-remove="false"  id="input-file-disable-remove"  />
                                       
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label class="">Upload Your Bio Data</label>
                                        <div class="">
                                            <input type="file" accept="application/pdf,.doc,.docx" name="resume" data-show-remove="false" @if($user_details && $user_details->userinfo) data-default-file="{{asset('upload/attach/'. $user_details->userinfo->resume)}}" @else required="" @endif id="input-file-disable-remove"  name="resume" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                <div class="form-group">
                                        <label class="" for="Present">Present Address</label>
                                        <textarea name="present_address" id="Present" placeholder="Enter present address" class="form-control"  rows="1">{{ ($user_details && $user_details->userinfo) ? $user_details->userinfo->present_address : old('present_address') }}</textarea>
                                    </div>
                                    </div>

                                    <div class="col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label class="" for="Permanent">Permanent  Address</label>
                                        <textarea name="permanent_address" id="Permanent"  class="form-control" placeholder="Enter permanent address" rows="1">{{ ($user_details && $user_details->userinfo) ? $user_details->userinfo->permanent_address :  old('permanent_address') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="row">
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="password">Password</label>
                                        <input type="password" value="{{old('password')}}" name="password" placeholder="Password" id="password" data-parsley-required-message = "Password is required" minlength="6"  class="form-control">
                                        @if ($errors->has('password'))
                                            <span class="error" role="alert">
                                               {{ $errors->first('password') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" for="password">Confirm Password</label>
                                       <input type="password" placeholder="Retype password" data-parsley-equalto="#password" value="{{old('password_confirmation')}}" name="password_confirmation" id="password2"  class="form-control">
                                        @if ($errors->has('password_confirmation'))
                                            <span class="error" role="alert">
                                               {{ $errors->first('password_confirmation') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div style=" display: flex!important;" class="d-flex no-block align-items-center">
                                        <div style="display: inline-flex;" class="custom-control custom-checkbox">
                                            <input type="checkbox" data-parsley-required-message = "Terms & Conditions  is required" class="custom-control-input" id="agree"> 
                                            <label style="margin: 0 5px;display: block;" class="custom-control-label" for="agree"> I've read and understood <a href="{{url('terms-of-use')}}" target="_blank" style="color: blue">Terms & Conditions </a></label>
                                        </div> 
                                        
                                    </div>
                                </div>

                                @if($reCaptcha->status == 1)
                                   
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="{{ $reCaptcha->public_key }}"></div>
                                        <span id="recaptcha-error" style="color: red"></span>
                                    </div>
                                    </div>
                                    
                                @endif
                        
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button id="submitBtn" class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Sign Up</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="form-group m-t-20">
                    <div class="col-sm-12 text-center">
                        Already have an account?  <a href="{{route('reporterLogin')}}" class="text-info m-l-5"><b>Sign In</b></a>
                    </div>
                </div>  
                   
            </div>

            
        </div>
    </div>
    </section>
@endsection

@section('js')
    <script src="{{asset('backend/assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{asset('backend/js/parsley.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script type="text/javascript">
        @if($reCaptcha->status == 1)
            $("#regiterForm").submit(function(event) {

               var recaptcha = $("#g-recaptcha-response").val();
               if (recaptcha === "") {
                  event.preventDefault();
                  $("#recaptcha-error").html("Recaptcha is required");
               }
            });
        @endif
    </script>
    <script>
    $(document).ready(function() {
        @if(Session::has('present_zilla')) 
            getUpazila("{{Session::get('present_zilla')}}", 'present_upazila');
        @endif
        @if(Session::has('permanent_zilla')) 
            getUpazila("{{Session::get('permanent_zilla')}}", 'permanent_upazila');
        @endif
        @if(Session::has('working_zilla')) 
            getUpazila("{{Session::get('working_zilla')}}", 'working_upazila');
        @endif
        // Basic
        $('.dropify').dropify();
    });
    </script>
    <script type="text/javascript">

        function getUpazila(id, field){
         
            var  url = '{{route("get_upazila_by_zilla", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#"+field).html(data);
                        $(".select2").select2();
                        $("#"+field).focus();
                    }else{
                        $("#"+field).html('<option value="">Upazila not found.</option>');
                    }
                }
            });
        }    

    </script>

    <script type="text/javascript">
        function checkField(value, field){

            if(value != ""){
                $.ajax({
                    method:'get',
                    url:"{{ route('checkField') }}",
                    data:{table:'users', field:field, value:value},
                    success:function(data){
                        if(data.status){
                            $('#'+field).html("");
                            
                            $('#submitBtn').removeAttr('disabled');
                            $('#submitBtn').removeAttr('style', 'cursor:not-allowed');
                            
                        }else{
                            $('#'+field).html("<span style='color:red'><i class='fa fa-times'></i> "+data.msg+"</span>");
                            
                            $('#submitBtn').attr('disabled', 'disabled');
                            $('#submitBtn').attr('style', 'cursor:not-allowed');
                            
                        }
                    },
                    error: function(jqXHR, exception) {
                        toastr.error('Unexpected error occur.');
                    }
                });
            }else{
                $('#'+field).html("<span style='color:red'>"+field +" is required</span>");
                
                $('#submitBtn').attr('disabled', 'disabled');
                $('#submitBtn').attr('style', 'cursor:not-allowed');
                
            }
        }
   
    $(".select2").select2();

    </script>
@endsection


