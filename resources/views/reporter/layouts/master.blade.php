<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
   <link rel="icon" href="{{ asset('upload/images/logo/'. config('siteSetting.favicon'))}}" type="image/x-icon">
    <title>@yield('title')</title>
    @include('backend.layouts.partials.css')
</head>

<body class="skin-blue-dark fixed-layout" >
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
<!--     <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Elite admin</p>
        </div>
    </div> -->
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
       @php 
            $user_id = Auth::guard('reporter')->id();
            $allPendingNews = App\Models\News::where('status', 'pending');
            if(!in_array('news_status', explode(',', Auth::guard('reporter')->user()->permission))){
                $allPendingNews->where('user_id', $user_id);
            }
            
            $allPendingNews = $allPendingNews->count();
           $reject_news = App\Models\News::where('user_id', $user_id)->where('status', 'reject')->count();
           
        @endphp
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        @include('reporter.layouts.partials.header')
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
       @include('reporter.layouts.partials.sidebar')
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
       <!-- ============================================================== -->
        
        @yield('content')
        <div class="modal fade" id="user_imageModal" role="dialog"  tabindex="-1" aria-hidden="true" >
            <div class="modal-dialog modal-sm">
              <!-- Modal content-->
              <div class="modal-content">
                  <div class="modal-header" style="border:none;">
                      Update Profile Image
                      <button type="button" id="modalClose" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body form-row">
                      <form action="{{route('reporter.changeProfileImage')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group" style="text-align: center;position: relative;"> 
                                <label for="wizard-picture">
                                <img src="{{asset('upload/images/users')}}/{{(Auth::guard('reporter')->user()->photo) ?  Auth::guard('reporter')->user()->photo : 'default.png'}}" style="width: 150px;height: 150px;border-radius: 50%;border: 2px solid #ccc;" class="picture-src" id="wizardPicturePreview" >
                                 <span  style="cursor: pointer; width: 22px;
    height: 22px; position: absolute;top: 45%;border: 1px solid #ccc;left: 40%;border-radius: 50%;padding:0px 4px;background: #ccc;"><i style="font-size:12px;" class="fa fa-camera"></i></span>
                                <input type="file" required="" style="display:none;"  name="photo" id="wizard-picture">
                               
                            </div>
                             <br/>
                                <i style="color: red;font-size: 12px;">Image Size: 250px*250px</i>
                            @if ($errors->has('profileImage'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('profileImage') }}
                                </span>
                            @endif
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" >Change Image</button>
                        </div>
                    </form>
                  </div>
              </div>
            </div>
        </div>
        <!-- footer -->
        <!-- ============================================================== -->

        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- End Wrapper -->

    <!-- All Jquery -->
    <!-- ============================================================== -->
    @include('backend.layouts.partials.scripts')
</body>

</html>
