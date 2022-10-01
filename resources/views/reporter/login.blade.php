@php
$verification_media = DB::table('general_settings')->first()->verification_media;
$is_otp_based_login_active = DB::table('site_settings')
->where('type','=','reporter_otp_based_login')
->first('status');
@endphp
@extends('frontend.layouts.master')
@section('title', 'Login | '.Config::get('siteSetting.site_name'))
@section('css')
<!-- page css -->
<link href="{{asset('backend/css/pages/login-register-lock.css')}}" rel="stylesheet">
<link href="{{asset('backend/css/app.css')}}" rel="stylesheet">

<style type="text/css">
    @media (min-width: 1200px) {
        .container {
            max-width: 1200px !important;
        }
    }

    .dropdown-toggle::after,
    .dropup .dropdown-toggle::after {
        content: initial !important;
    }

    .card-footer,
    .card-header {
        margin-bottom: 5px;
        border-bottom: 1px solid #ececec;
    }

    #recoverform {
        display: none;
    }

    .loginArea {
        background: #fff;
        border-radius: 5px;
        margin: 10px 0;
        padding: 20px;
    }
    .invalid-login-feedback {
        color: red;
        font-size: 12px;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div id="pageLoading" style="display: none;"></div>
    <div class="row justify-content-center">
        <div class="col-md-3 col-xs-12"></div>
        <div class="col-md-6 col-xs-12 ">
            <div class="card loginArea">
                <div class="card-body">
                    <div id="loginform">
                        <form class="form-horizontal form-material">
                            <div class="card-header text-center">
                                <h3>Reporter Login</h3>
                            </div>
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

                            <div>
                                <span class="invalid-login-feedback" role="alert" id="login_error"></span>
                            </div>
                            <div class="lds-dual-ring" id="loader">
                                <img src="{{asset('backend/assets/images/loader.gif')}}" alt="">
                            </div>

                            <div id="password_based_login">
                                <div class="form-group">
                                    <label class="control-label" for="emailOrMobile">Email or Mobile Number</label>
                                    <input type="text" name="emailOrMobile" placeholder="Enter Email or Mobile Number "
                                        id="input-email" required=""
                                        data-parsley-required-message="Email or Mobile number is required"
                                        class="form-control">
                                    @if ($errors->has('emailOrMobile'))
                                    <span class="error" role="alert">
                                        {{ $errors->first('emailOrMobile') }}
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="input-password">Password</label>
                                    <input type="password" required="" name="password" value="" placeholder="Password"
                                        id="input-password" data-parsley-required-message="Password is required"
                                        class="form-control">
                                    @if ($errors->has('password'))
                                    <span class="error" role="alert">
                                        {{ $errors->first('password') }}
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div style=" display: flex!important;"
                                            class="d-flex no-block align-items-center">
                                            <div style="display: inline-flex;" class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="Remember">
                                                <label style="margin: 0 5px;" class="custom-control-label"
                                                    for="Remember">
                                                    Remember me</label>
                                            </div>
                                            <div class="ml-auto" style="margin-left: auto!important;">
                                                <a href="javascript:void(0)" id="to-recover" class="text-muted"><i
                                                        class="fa fa-lock"></i> Forgot pwd?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if($is_otp_based_login_active->status == 1)
                                <div class="form-group text-center">
                                    <button class="btn btn-block btn-lg btn-info btn-rounded"
                                        id="submit_password_based_login" onclick="passwordBasedLogin()"
                                        type="button">Next</button>
                                </div>
                                @else
                                <div class="form-group text-center">
                                    <button class="btn btn-block btn-lg btn-info btn-rounded"
                                        id="submit_password_based_login" onclick="directLogin()"
                                        type="button">Login</button>
                                </div>
                                @endif


                                <div class="form-group m-b-0">
                                    <div class="col-sm-12 text-center">
                                        Don't have an account? <a href="{{ route('reporterRegister') }}"
                                            class="text-info m-l-5"><b>Sign Up</b></a>
                                    </div>
                                </div>
                            </div>
                            @if($is_otp_based_login_active->status == 1)
                            @if($verification_media == 'both' || $verification_media == 'sms')
                            <div id="captcha">
                                <div class="form-group">
                                    <div id="recaptcha-container"></div>
                                </div>
                            </div>
                            @endif

                            @if($verification_media == 'both')
                            <div id="select-media">
                                <p>Select a media for verification</p>
                                <div class="form-group">
                                    <select class="form-control" onchange="selectVerificationMedia()"
                                        id="verification_media">
                                        <option value="-1">Select OTP Sending Media</option>
                                        <option value="email">Email based verification</option>
                                        <option value="sms">SMS based verification
                                        </option>
                                    </select>
                                </div>
                            </div>
                            @endif

                            <div id="otp_based_login">
                                <p>
                                    Enter the code in the form bellow to verify your identity.
                                </p>
                                <div class="form-group">
                                    <input type="hidden" name="mobile" value="" id="mobile_for_otp">
                                </div>

                                <div class="form-group">
                                    <input type="text" value="" required="" name="otp" placeholder="Please provide otp"
                                        id="input-otp" class="form-control">
                                    <span class="error" role="alert" id="otp_error"></span>
                                </div>

                                @if($verification_media == 'both')
                                <div class="form-group text-center">
                                    <button type="button" class="btn btn-block btn-lg btn-info btn-rounded"
                                        onclick="giveOtp()">Login</button>
                                </div>
                                @endif
                                @if($verification_media == 'sms')
                                <div class="form-group text-center">
                                    <button type="button" class="btn btn-block btn-lg btn-info btn-rounded"
                                        onclick="verifyPhoneNumber()">Login</button>
                                </div>
                                @endif
                                @if($verification_media == 'email')
                                <div class="form-group text-center">
                                    <button type="button" class="btn btn-block btn-lg btn-info btn-rounded"
                                        onclick="verifyEmail()">Login</button>
                                </div>
                                @endif
                            </div>
                            @endif
                        </form>
                    </div>
                    <form class="form-horizontal" method="post" id="recoverform"
                        action="{{ route('reporter.password.recover') }}">
                        @csrf
                        <div class="form-group">
                            <div class="col-xs-12">
                                <h3>Recover Password</h3>
                                <p class="text-muted">Enter your Mobile or Email and instructions will be sent to you!
                                </p>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" id="reseField" name="emailOrMobile" type="text" required
                                    placeholder="Mobile or Email">
                                @if ($errors->has('emailOrMobile'))
                                <span class="error" role="alert">
                                    {{ $errors->first('emailOrMobile') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light"
                                    id="resetBtn" type="submit">Reset Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-3 col-xs-12"></div>
        </div>
    </div>
</div>
@endsection

@section('js')
<!--Custom JavaScript -->
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
<script>
    const firebaseConfig = {
        apiKey: "{{ env('FIREBASE_API_KEY') }}",
        authDomain: "{{ env('FIREBASE_AUTH_DOMAIN') }}",
        projectId: "{{ env('FIREBASE_PROJECT_ID') }}",
        storageBucket: "{{ env('FIREBASE_STORAGE_BUCKET') }}",
        messagingSenderId: "{{ env('FIREBASE_MESSAGE_SENDER_ID') }}",
        appId: "{{ env('FIREBASE_APP_ID') }}",
        measurementId: "{{ env('FIREBASE_MEASUREMENT_ID') }}"
    };
                    
    firebase.initializeApp(firebaseConfig);
</script>
<script type="text/javascript">
    let captcha = null
        $(function() {
            $("#otp_based_login").hide();
            $("#select-media").hide();
            $("#captcha").hide();
            $("#loader").hide();
        });

        function passwordBasedLogin(){
            $('#loader').show()
            $('#password_based_login').attr('disabled',true)

            let emailOrMobile = $('#input-email').val()
            let password = $('#input-password').val()

            $.post("{{ route('validate.reporter.login') }}", {
                _token: '{{ csrf_token() }}',
                emailOrMobile: emailOrMobile,
                password: password
            },
            function(data, status) {
                $('#loader').hide()
                $('#password_based_login').attr('disabled',false)

                $('#mobile_for_otp').val(data.mobile)
                $("#login_error").html('');
                $("#password_based_login").hide();
                $("#select-media").show();

                let verification_media = '{{$verification_media}}'
                
                if(verification_media == 'sms'){
                    $("#captcha").show();
                    render()
                }
                
                if(verification_media == 'email'){
                    sendEmailOtp()
                }
            }).fail(function(xhr, status, error) {
                $('#loader').hide()
                $('#login_error').html('Invalid Login Credentials')
            });
        }

        function selectVerificationMedia(){
            var selected_media = $('#verification_media').val()
            if(selected_media == 'sms'){
                $("#select-media").hide();
                $("#captcha").show();
                render()
            }
            if(selected_media == 'email'){
                sendEmailOtp()
            }
        }

        function sendEmailOtp() {
                $('#loader').show()
                let emailOrMobile = $('#input-email').val()
                console.log(emailOrMobile);
                
                $.post("{{ route('send.reporter.email.otp') }}", {
                    _token: '{{ csrf_token() }}',
                    emailOrMobile: emailOrMobile
                },
                function(data, status) {
                    $('#loader').hide()
                    $("#select-media").hide();
                    $("#login_error").html('');
                    $("#otp_based_login").show()
                }).fail(function(xhr, status, error) {
                    console.log(xhr)
                    $('#loader').hide()
                    $('#login_error').html('Invalid Login Credentials')
                });
        }

        function render() {
            $('#loader').show()
            captcha = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
            'callback': (response) => {
                $('#loader').hide()
                $("#login_error").html('');
                $("#captcha").hide();
                sendFirebasePhoneOTP()
            },
            'expired-callback': () => {
                $('#loader').hide()
                $("#login_error").html("Please Solve the captche");
            }
            })
            window.recaptchaVerifier = captcha
            recaptchaVerifier.render();
        }

        function giveOtp(){
            var selected_media = $('#verification_media').val()
            if(selected_media == 'sms'){
                verifyPhoneNumber()
            }
            else{
                verifyEmail()
            }
        }
        
        function sendFirebasePhoneOTP() {
            $('#loader').show()
            let is_recaptcha_verified = false;
            var phoneNumber = '+88'+$("#mobile_for_otp").val();
            firebase_response = firebase.auth().signInWithPhoneNumber(phoneNumber, window.recaptchaVerifier)
            .then(function (confirmationResult) {
                $('#loader').hide()
                console.log("Hello 02")
                console.log(confirmationResult)
                $("#login_error").html('');
                window.confirmationResult = confirmationResult;
                coderesult = confirmationResult;
                is_recaptcha_verified = true
                console.log("Hello 04")    
            }).catch(function (error) {
                console.log(error)
                $('#loader').hide()
                $("#login_error").html(error.message);
            });
            
            setTimeout(() => {
                if(!is_recaptcha_verified){
                    $("#login_error").html("Please verify captcha");
                    $("#password_based_login").show();
                    $("#otp_based_login").hide();
                }
                else{
                    $("#password_based_login").hide();
                    $("#otp_based_login").show();
                }
            }, "3000")
        }
        
        function verifyPhoneNumber() {
            $('#loader').show()
            var code = $("#input-otp").val();
            coderesult.confirm(code).then(function (res) {
                $('#loader').hide()
                $("#login_error").html('');
                var user = res.user;
                console.log("Auth successful");
                console.log(user);

                let emailOrMobile = $('#input-email').val()
                let password = $('#input-password').val()

                $.post("{{ route('reporterLogin') }}", {
                    _token: '{{ csrf_token() }}',
                    emailOrMobile: emailOrMobile,
                    password: password
                },
                function(data, status) {
                    $('#loader').hide()
                    location.reload()
                }).fail(function(xhr, status, error) {
                    $('#loader').hide()
                    $('#login_error').html('Invalid Login Credentials')
                });
            }).catch(function (error) {
                $('#loader').hide()
                $("#login_error").html(error.message);
            });
        }


        function directLogin() {
            $('#loader').show()
            
            let emailOrMobile = $('#input-email').val()
            let password = $('#input-password').val()
            
            $.post("{{ route('reporterLogin') }}", {
                _token: '{{ csrf_token() }}',
                emailOrMobile: emailOrMobile,
                password: password
            },
            function(data, status) {
                $('#loader').hide()
                location.reload()
            }).fail(function(xhr, status, error) {
                $('#loader').hide()
                $('#login_error').html('Invalid Login Credentials')
            });
        }

        function verifyEmail() {
            $('#loader').show()
            var code = $("#input-otp").val();
            let emailOrMobile = $('#input-email').val()
            let password = $('#input-password').val()

            $.post("{{ route('verify.reporter.email.otp') }}", {
                _token: '{{ csrf_token() }}',
                emailOrMobile: emailOrMobile,
                password: password,
                code: code
            },
            function(data, status) {
                $('#loader').hide()
                location.reload()
            }).fail(function(xhr, status, error) {
                $('#loader').hide()
                console.log(xhr)
                $('#login_error').html('Invalid Login Credentials')
            });
        }
</script>
<script type="text/javascript">
    $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });  

        $('#socialloginBtn').on("click", function() {
           
            document.getElementById('pageLoading').style.display = 'block';
        });

        $('#resetBtn').click('on', function(){
            var reseField = $('#reseField').val();
            if(reseField){
                $('#resetBtn').html('Sending...');
            }
        });
</script>
@endsection