@extends('backend.layouts.master')
@section('title', 'Add reporter')
@section('css')
    <link href="{{asset('backend/assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
   
    <style>

        .page-titles {
            margin: 0 -25px 5px !important;
        }
        .dropify-wrapper{
            margin-bottom: 10px;
        }
        .dropify_image_area{
            position: absolute;top: -14px;left: 12px;background:#fff;padding: 3px;
        }
        .bootstrap-tagsinput{
            width: 100% !important;
            padding: 5px;
        }
        .head-label{
            position:relative;padding: 15px; border: 1px solid #e1e1e1; margin-bottom: 15px;
        }
    </style>
@endsection

@section('content')

    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <div class="container-fluid" style="padding: 0 10px !important;">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Add Reporter </h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="{{route('reporter.list')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Reporter List</a>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->

            <div class="card">
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
                        <form data-parsley-validate action="{{route('reporter.store')}}" enctype="multipart/form-data" id="regiterForm" method="post" >
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-12"><h3>Personal Details</h3></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="control-label required" for="name">Full Name</label>
                                      <input type="text" required name="name" value="{{old('name')}}" placeholder="Enter Full Name" data-parsley-required-message = "Name is required" id="name" class="form-control">
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
                                      <label class="control-label" for="mobile">Mobile Number</label>
                                      <input type="mobile" pattern="/(01)\d{9}/" name="mobile" value="{{ old('mobile')}}" placeholder="Enter Mobile Number" data-parsley-required-message = "Mobile number is required" class="form-control">
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
                                      <input type="email" onblur="checkField(this.value, 'email')"  onkeyup ="checkField(this.value, 'email')" name="email" value="{{ old('email')}}" pattern="[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-zA-Z]{2,4}" placeholder="Enter Email Address"  class="form-control">
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
                                        <label for="gender">Gender</label>
                                       <select  name="gender"  id="gender" class="form-control custom-select">
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ (old('gender') =='male') ? 'selected' : '' }}>Male</option>
                                            <option value="female" {{ (old('gender') =='female') ? 'selected' : '' }}>Female</option>
                                            <option value="others" {{ (old('gender') =='others') ? 'selected' : '' }}>Others</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label  for="blood">Blood Group</label>
                                        <select  name="blood"  id="blood" class="form-control custom-select">
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
                                        <label for="birthdate" class="control-label ">Date of Birth</label>
                                        <input  name="birthday" value="{{ old('birthday') }}"  id="birthdate" type="date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="profession">Current Profession</label>
                                        <input value="{{ old('profession')}}" type="text" class="form-control @error('profession') is-invalid @enderror" name="profession"  id="profession" placeholder="Enter profession">

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
                                        <input type="text" value="{{ old('father_name') }}" placeholder="Enter father's name" name="father_name"  id="Fathers" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Mothers">Mother's Name</label>
                                        <input type="text"   value="{{ old('mother_name') }}" name="mother_name" placeholder="Enter mother's name" id="Mothers" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="national_id" >NID/Passport/Driving Licence</label>
                                        <input value="{{ old('national_id')}}" type="text" class="form-control @error('national_id') is-invalid @enderror" placeholder="Enter NID/Passport/Driving Licence" name="national_id"  id="national_id" autofocus>

                                        @error('national_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Upload NID/Passport/Driving Licence</label><br>
                                       
                                        <input type="file" name="national_attach" />
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label >Upload Your Recent Photo</label>
                                        
                                            <input type="file" accept="image/*" name="photo"  data-show-remove="false"  id="input-file-disable-remove" class="dropify" />
                                       
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <div class="form-group">
                                        <label >Upload Your Bio Data</label>
                                        <div class="">
                                            <input type="file" accept="application/pdf,.doc,.docx" name="resume" data-show-remove="false" id="input-file-disable-remove" class="dropify" name="resume" />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                   
                                    <div class="form-group">
                                        <label for="Present">Present Address</label>
                                        <textarea  name="present_address" id="Present" placeholder="Enter present address" class="form-control"  rows="1">{{ old('present_address') }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    
                                    <div class="form-group">
                                        <label  for="Permanent">Permanent  Address</label>
                                        <textarea  name="permanent_address" id="Permanent"  class="form-control" placeholder="Enter permanent address" rows="1">{{ old('permanent_address') }}</textarea>
                                    </div>
                                </div>
                            </div>
                                
                            
                            <div class="row">
                            
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label required" for="password">Password</label>
                                        <input type="password" value="{{old('password')}}" name="password" placeholder="Password" required id="password" data-parsley-required-message = "Password is required" minlength="6"  class="form-control">
                                        @if ($errors->has('password'))
                                            <span class="error" role="alert">
                                               {{ $errors->first('password') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label required" for="password">Confirm Password</label>
                                       <input type="password" placeholder="Retype password" data-parsley-equalto="#password" required="" value="{{old('password_confirmation')}}" name="password_confirmation" id="password2"  class="form-control">
                                        @if ($errors->has('password_confirmation'))
                                            <span class="error" role="alert">
                                               {{ $errors->first('password_confirmation') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                        
                                <div class="form-group text-center">
                                    <div class="col-xs-12 p-b-20">
                                        <button id="submitBtn" class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Create now</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
@endsection
@section('js')
    <script src="{{asset('backend/assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

    <script src="{{asset('backend/assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>

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

