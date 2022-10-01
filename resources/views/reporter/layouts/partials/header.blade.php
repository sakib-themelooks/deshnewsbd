<style>
.collapse.in,
.skin-blue-dark .left-sidebar {
    background: #fff;
}
.note-editor.note-frame .note-editing-area .note-editable {
    height: 400px !important;
}
</style>
<header class="topbar" style="background:{{ config('siteSetting.header_bg_color') }}; color: {{ config('siteSetting.header_text_color')}}"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a target="_blank" class="navbar-brand" href="{{route('reporter.dashboard')}}">
               
            <b><img  src="{{ asset('upload/images/logo/'.config('siteSetting.favicon'))}}" alt="homepage" class="light-logo" />
            </b><span>
             <!-- Light Logo text -->    
             <img src="{{ asset('upload/images/logo/'.config('siteSetting.logo'))}}" width="100" height="30" class="light-logo" alt="homepage" /></span> 
            <!--End Logo icon -->
            </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto">
                <!-- This is  -->
                <li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
                
            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                <!-- ============================================================== -->
         
                <li class="nav-item">
                    <a target="_blank" title="Go to homepage" class="nav-link dropdown-toggle waves-effect waves-dark" href="{{url('/')}}" > <i class="fa fa-globe"></i></a>
                </li>
               
                <!-- User Profile -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown u-pro">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{asset('upload/images/users')}}/{{(Auth::guard('reporter')->user()->photo) ? Auth::guard('reporter')->user()->photo : 'default.png'}}" alt="user" class=""> <span class="hidden-md-down"> &nbsp;<i class="fa fa-angle-down"></i></span> </a>
                    <div class="dropdown-menu dropdown-menu-right animated flipInY">
                        <!-- text-->
                        <a href="{{route('reporter.profile')}}" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                        <!-- text-->
                        <a href="{{route('reporter.change-password')}}" class="dropdown-item"><i class="ti-wallet"></i> Password Change</a>
                     
                        <a href="javascript:void(0)" class="dropdown-item"><i class="ti-settings"></i> Setting</a>
                        <!-- text-->
                        <div class="dropdown-divider"></div>
                        <!-- text-->
                        <a  href="javascript:void(0)" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                        <!-- text-->
                        <form id="logout-form" action="{{ route('reporterLogout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End User Profile -->
               
            </ul>
        </div>
    </nav>
</header>
