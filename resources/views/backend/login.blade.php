@php
$verification_media = DB::table('general_settings')->first()->verification_media;
$is_otp_based_login_active = DB::table('site_settings')
->where('type','=','admin_otp_based_login')
->first('status');
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('upload/images/logo/'. config('siteSetting.favicon'))}}">
    <title>Admin Login pannel</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ mix('backend/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/custom.css') }}">
    <!-- page css -->
    <link href="{{asset('backend/css/pages/login-register-lock.css')}}" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .lds-dual-ring {
            display: inline-block;
            width: 20px;
            height: 20px;
        }
    </style>
</head>

<body class="skin-default card-no-border">

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register"
            style="background-image:url({{asset('assets')}}/images/background/login-register.jpg);">
            <div class="login-box card">
                <div class="card-body" style="text-align: center;">
                    <a href="{{route('home')}}">
                        <img src="{{ asset('upload/images/logo/'.config('siteSetting.logo'))}}" width="65%"
                            alt="homepage" class="dark-logo" /></a>
                    <hr />
                    <form class="form-horizontal form-material" method="post" id="loginform">
                        @csrf
                        @if(Session::has('status'))
                        <div class="alert alert-success">
                            <strong>Success! </strong> {{Session::get('status')}}
                        </div>
                        @endif
                        @if(Session::has('error'))
                        <div class="alert alert-danger">
                            {{Session::get('error')}}
                        </div>
                        @endif

                        <div>
                            <span class="invalid-feedback" role="alert" id="login_error"></span>
                        </div>
                        <div class="lds-dual-ring" id="loader">
                            <img src="{{asset('backend/assets/images/loader.gif')}}" alt="">
                        </div>


                        <div id="password_based_login">
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <input id="emailOrMobile" placeholder="Enter Email or Mobile" type="text"
                                        class="form-control @error('emailOrMobile') is-invalid @enderror"
                                        name="emailOrMobile" value="{{ old('emailOrMobile') }}" required
                                        autocomplete="emailOrMobile" autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Enter Password" name="password" required
                                        autocomplete="current-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="d-flex no-block align-items-center">
                                        <div class="custom-control custom-checkbox">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                        <div class="ml-auto">
                                            <a href="javascript:void(0)" id="to-recover" class="text-muted"><i
                                                    class="fas fa-lock m-r-5"></i> Forgot pwd?</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($is_otp_based_login_active->status == 1)
                            <div class="form-group text-center">
                                <div class="col-xs-12 p-b-20">
                                    <button class="btn btn-block btn-lg btn-info btn-rounded"
                                        id="submit_password_based_login" onclick="passwordBasedLogin()"
                                        type="button">Next</button>
                                </div>
                            </div>
                            @else
                            <div class="form-group text-center">
                                <div class="col-xs-12 p-b-20">
                                    <button class="btn btn-block btn-lg btn-info btn-rounded"
                                        id="submit_password_based_login" onclick="directLogin()"
                                        type="button">Login</button>
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- OTP based authentication process -->
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
                        <!-- OTP based authentication process -->
                    </form>
                    <form class="form-horizontal" id="recoverform" action="index.html">
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>Recover Password</h3>
                                <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light"
                                    type="submit">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('backend/assets')}}/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('backend/assets')}}/node_modules/popper/popper.min.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

    <!--Custom JavaScript -->
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
        let coderesult = null
        $(function() {
            $("#otp_based_login").hide();
            $("#select-media").hide();
            $("#captcha").hide();
            $("#loader").hide();
        });

        function passwordBasedLogin(){
            $('#loader').show()
            $('#password_based_login').attr('disabled',true)

            let emailOrMobile = $('#emailOrMobile').val()
            let password = $('#password').val()

            $.post("{{ route('validate.login.credentials') }}", {
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
                $('#password_based_login').attr('disabled',false)
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
            let emailOrMobile = $('#emailOrMobile').val()
            console.log(emailOrMobile);

            $.post("{{ route('send.email.otp') }}", {
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
                $("#login_error").html('');
                window.confirmationResult = confirmationResult;
                coderesult = confirmationResult;
                is_recaptcha_verified = true  
                
                $("#select-media").hide();
                $("#otp_based_login").show()
            }).catch(function (error) {
                console.log(error)
                $('#loader').hide()
                $("#login_error").html(error.message);
            });
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

                let emailOrMobile = $('#emailOrMobile').val()
                let password = $('#password').val()

                $.post("{{ route('adminLoginForm') }}", {
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
            let emailOrMobile = $('#emailOrMobile').val()
            let password = $('#password').val()
            
            $.post("{{ route('adminLoginForm') }}", {
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
            let emailOrMobile = $('#emailOrMobile').val()
            let password = $('#password').val()

            $.post("{{ route('verify.email.otp') }}", {
                _token: '{{ csrf_token() }}',
                emailOrMobile: emailOrMobile,
                password: password,
                code: code
            },
            function(data, status) {
                $('#loader').hide()
                location.reload()
            }).fail(function(xhr, status, error) {
                console.log(xhr)
                $('#loader').hide()
                $('#login_error').html('Invalid Login Credentials')
            });
        }
    </script>
    <script type="text/javascript">
        $(function() {
        $(".preloader").fadeOut();
    });

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
    </script>
    <!-- Popup message jquery -->
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

    {!! Toastr::message() !!}
    <script>
        @if($errors->any())
            @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
</body>

</html>