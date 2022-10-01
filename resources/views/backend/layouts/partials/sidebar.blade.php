@php
function hasPermission($permission_id)
{
if(Auth::user()->role_id == 'admin'){
return true;
}
else{
return DB::table('user_has_permissions')
->where('user_id','=',Auth::user()->id)
->where('permission_id','=',$permission_id)
->exists();
}
}
@endphp
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">

        <!-- Sidebar navigation-->
        <nav class="sidebar-nav" style="padding: 0">

            <ul id="sidebarnav">

                @if(hasPermission(Config('settings.permissions.dashboard')))
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('admin.dashboard') }}" aria-expanded="false"><i
                            class="icon-speedometer"></i><span class="hide-menu">Dashboard</a>
                </li>
                @endif

                @php
                $allPendingNews = App\Models\News::where('status', 'pending')->count();
                @endphp

                @if(hasPermission(Config('settings.permissions.post_section')))
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                            class="ti-pencil-alt"></i><span class="hide-menu">Post Section <span
                                class="badge badge-pill badge-cyan ml-auto">{{ $allPendingNews }}</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('news.create')}}">Add Post</a></li>
                        <li><a href="{{route('news.list')}}">Post list</a></li>
                        <li><a href="{{route('news.list', 'pending')}}">Pending post <span
                                    class="badge badge-pill badge-cyan ml-auto">{{ $allPendingNews }}</span></a></li>
                        <!--<li><a href="{{route('news.list', 'bd')}}">Bangla News </a></li>
                        <li><a href="{{route('news.list', 'en')}}">English News </a></li> -->
                        <!-- <li><a href="{{route('news.list', 'reject')}}">Reject News</a></li> -->
                        <li><a href="{{route('news.list', 'draft')}}">Draft post</a></li>
                        <!--<li><a href="{{route('news.list', 'audio')}}">Audio News</a></li>
                        <li><a href="{{route('news.list', 'video')}}">Video News</a></li>
                        <li><a href="{{route('news.list', 'schedule')}}">Schedule News</a></li>
                        <li><a href="{{route('news.list', 'breaking')}}">Breaking News</a></li>
                        <li><a href="{{route('news.list', 'featured')}}">Featured News</a></li> --->
                    </ul>
                </li>
                @endif

                @if(hasPermission(Config('settings.permissions.page')))
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                            class="fa fa-file-word"></i><span class="hide-menu">Page</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('page.create')}}">Add Page</a></li>
                        <li><a href="{{route('page.list')}}">Page list</a></li>
                    </ul>
                </li>
                @endif

                @if(hasPermission(Config('settings.permissions.menu_builder')))
                <li> <a class="waves-effect waves-dark" href="{{route('menuBuilder')}}" aria-expanded="false"><i
                            class="ti-align-left"></i><span class="hide-menu">Menu Builder</a></li>
                @endif

                @if(hasPermission(Config('settings.permissions.banner')))
                <li> <a class="waves-effect waves-dark" href="{{route('banner')}}" aria-expanded="false"><i
                            class="ti-align-left"></i><span class="hide-menu">Banner</a></li>
                @endif

                @if(hasPermission(Config('settings.permissions.category')))
                <!-- <li><a href="{{route('admin.homepageSection')}}"><i class="ti-settings"></i><span class="hide-menu"> Homepage Setting</a></span></li> -->
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                            class="ti-server"></i><span class="hide-menu">Category</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('category.list') }}">Category list</a></li>
                        <li><a href="{{ route('subcategory.list') }}">SubCategory list</a></li>
                        <li><a href="{{ route('subchildcategory') }}">Childcategory list</a></li>

                    </ul>
                </li>
                @endif


                @if(hasPermission(Config('settings.permissions.services')))
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                            class="fa fa-flag"></i><span class="hide-menu">Services</span></a>
                    <ul aria-expanded="false" class="collapse">

                        <li><a href="{{route('service.create')}}">Service create</a></li>
                        <li><a href="{{route('service.list')}}">Service list</a></li>
                        <li><a href="{{route('serviceType.list')}}">Service Type</a></li>
                        <li><a href="{{route('serviceQueryList')}}">Service Query</a></li>
                    </ul>
                </li>
                @endif

                @if(hasPermission(Config('settings.permissions.location')))
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                            class="fa fa-flag"></i><span class="hide-menu">Location</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('division.index')}}">Division</a></li>
                        <li><a href="{{route('district.index')}}">District</a></li>
                        <li><a href="{{route('upzilla.index')}}">Upzilla</a></li>
                    </ul>
                </li>
                @endif

                @if(hasPermission(Config('settings.permissions.media_gallery')))
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                            class="ti-gallery"></i><span class="hide-menu">Media Gallery</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('photo.gallery')}}">Photo Gallery</a></li>
                        <li><a href="{{route('video.gallery')}}">Video Gallery</a></li>
                    </ul>
                </li>
                @endif

                @if(hasPermission(Config('settings.permissions.general_settings')))
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                            class="ti-settings"></i><span class="hide-menu">General Settings</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('generalSetting')}}">Setting</a></li>
                        <li><a href="{{route('site_settings')}}">Site Settings</a></li>
                        <li><a href="{{route('admin.profileUpdate')}}">Profile Setting</a></li>

                        <li><a href="{{route('logoSetting')}}">Logo Setting</a></li>
                        <li><a href="{{route('popularNewsCountDay')}}">Popular News Day</a></li>
                        <li><a href="{{route('headerSetting')}}">Header Setting</a></li>
                        <li><a href="{{route('footerSetting')}}">Footer Setting</a></li>
                        <li><a href="{{route('seoSetting')}}">SEO Setting</a></li>
                        <li><a href="{{route('googleSetting')}}">Analytics & Adsense</a></li>
                        <li><a href="{{route('google_recaptcha')}}">Google reCaptcha</a></li>
                        <li><a href="{{route('admin.passwordChange')}}">Change Password</a></li>
                        <li><a href="{{route('socialLoginSetting')}}">Social Media Login</a></li>
                        <li><a href="{{route('socialSetting')}}">Social Link</a></li>
                    </ul>
                </li>
                @endif

                <!--
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">SMTP & OTP Config</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('otp_configurations')}}">OTP Configurations</a></li>
                        <li><a href="{{route('smtp_settings')}}">SMTP settings</a></li>
                    </ul>
                </li>
                -->

                @if(hasPermission(Config('settings.permissions.advertisement')))
                <li> <a class="waves-effect waves-dark" href="{{route('addvertisement.list')}}" aria-expanded="false"><i
                            class="ti-layout-media-right-alt"></i><span class="hide-menu">Advertisement</span></a></li>

                @endif

                @if(hasPermission(Config('settings.permissions.polls')))
                <li> <a class="waves-effect waves-dark" href="{{ route('admin.poll.list') }}" aria-expanded="false"><i
                            class="fa fa-hourglass-half"></i><span class="hide-menu">Polls</a>
                </li>
                @endif

                <!--
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-comment"></i><span class="hide-menu">Comments</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('allComments')}}">Comments</a></li>
                    </ul>
                </li>
                --->


                @php $pendingReporters = App\User::where('role_id', 'reporter')->where('status', 'pending')->count();
                @endphp

                @if(hasPermission(Config('settings.permissions.reporter')))
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                            class="ti-write"></i><span class="hide-menu">Reporter <span
                                class="badge badge-pill badge-primary text-white ml-auto">{{$pendingReporters}}</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('reporter.create')}}">Add Reporter</a></li>
                        <li><a href="{{route('reporter.list')}}">All Reporters</a></li>
                        <li><a href="{{route('reporter.list', 'pending')}}">Reporter Request <span
                                    class="badge badge-primary badge-cyan ml-auto">{{ $pendingReporters }}</span></a>
                        </li>
                    </ul>
                </li>
                @endif

                @if(hasPermission(Config('settings.permissions.manage_users')))
                <li> <a class="waves-effect waves-dark" href="{{route('admin.user.list')}}" aria-expanded="false"><i
                            class="fa fa-users"></i><span class="hide-menu">Manage Users </span></a>
                </li>
                @endif


                <li> <a class="waves-effect waves-dark" href="{{ route('logout') }}" onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();" aria-expanded="false"><i
                            class="icon-logout text-success"></i><span class="hide-menu">Log Out</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>