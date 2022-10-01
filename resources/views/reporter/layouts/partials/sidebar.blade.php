<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">

        <!-- Sidebar navigation-->
        <nav class="sidebar-nav" style="padding: 0">
            <ul id="sidebarnav">

                
                <li> <a class="waves-effect waves-dark" href="{{ route('reporter.dashboard') }}" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">Dashboard</a>
                </li>

    
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-pencil-alt"></i><span class="hide-menu">News Section <span class="badge badge-pill badge-cyan ml-auto">{{ $allPendingNews + $reject_news }}</span></span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('reporter.news.create')}}">Create News</a></li>
                        <li><a href="{{route('reporter.news.list')}}">All News</a></li>
                         <li><a href="{{route('reporter.news.list', 'pending')}}">Pending News <span class="badge badge-pill badge-cyan ml-auto">{{ $allPendingNews }}</span></a></li>
                         <li><a href="{{route('reporter.news.list', 'reject')}}">Reject News <span class="badge badge-pill badge-primary ml-auto">{{ $reject_news }}</span></a></li>
                         <li><a href="{{route('reporter.news.list', 'draft')}}">Draft News </a></li>
                        <!-- <li><a href="{{route('reporter.news.list', 'bd')}}">Bangla News </a></li>
                        <li><a href="{{route('reporter.news.list', 'en')}}">English News </a></li>
                        <li><a href="{{route('reporter.news.list', 'audio')}}">Audio News</a></li>
                        <li><a href="{{route('reporter.news.list', 'video')}}">Video News</a></li> -->
                       
                    </ul>
                </li>
               
                <li> <a class="waves-effect waves-dark" href="{{route('reporter.profile')}}" aria-expanded="false"><i class="ti-user"></i><span class="hide-menu">Account Setting</a>
                </li>

                <li> <a class="waves-effect waves-dark" href="{{route('reporter.change-password')}}" aria-expanded="false"><i class="fa fa-eye-slash"></i><span class="hide-menu">Change Password</a>
                </li>
                
               
                <li> <a class="waves-effect waves-dark" href="javascript:void(0)" onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();" aria-expanded="false"><i class="far fa-circle text-success"></i><span class="hide-menu">Log Out</span></a>
                    <form id="logout-form" action="{{ route('reporterLogout') }}" method="POST" style="display: none;">
                         @csrf
                    </form></li>
            </ul>
            
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
