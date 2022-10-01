@extends('reporter.layouts.master')
@section('title', "Dashboard")
@section('css')
    <!-- chartist CSS -->
    <link href="{{asset('backend')}}/assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="{{asset('backend')}}/css/pages/dashboard1.css" rel="stylesheet">
    <style type="text/css">
        @-webkit-keyframes blinker {from {opacity: 1.0;} to {opacity: 0.3;} }
        .blink{text-decoration: blink;-webkit-animation-name: blinker;-webkit-animation-duration: 0.7s;-webkit-animation-iteration-count:infinite;-webkit-animation-timing-function:ease-in-out;-webkit-animation-direction: alternate;color: #ffbc00; margin-bottom: 10px; font-weight: bold;}
    </style>
@endsection
@section('content')

    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Dashboard</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        
                    </div>
                </div>
            </div>
           
           
            @php $reject_news = App\Models\News::where('user_id', Auth::guard('reporter')->id())->where('status', 'reject')->count(); @endphp
                        @if($reject_news)
                        <div class="alert alert-danger">
                          <strong>Reject News: </strong> <a href="{{route('reporter.news.list', 'reject')}}"><span class="badge badge-pill badge-primary ml-auto">{{ $reject_news }}</span></a> 
                        </div>
                    @endif
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Info box -->
            <!-- ============================================================== -->
            <div class="card-group">

                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h3><i class="icon-screen-desktop"></i></h3>
                                        <p class="text-muted">TOTAL NEWS</p>
                                    </div>
                                    <div class="ml-auto">
                                        <h2 class="counter text-primary">{{$news}}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h3><i class="icon-note"></i></h3>
                                        <p class="text-muted">PENDING NEWS</p>
                                    </div>
                                    <div class="ml-auto">
                                        <h2 class="counter text-cyan">{{$pending_news}}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="progress">
                                    <div class="progress-bar bg-cyan" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h3><i class="icon-doc"></i></h3>
                                        <p class="text-muted">Reject news</p>
                                    </div>
                                    <div class="ml-auto">
                                        <h2 class="counter text-purple"> {{$reject_news }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="progress">
                                    <div class="progress-bar bg-purple" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h3><i class="icon-bag"></i></h3>
                                        <p class="text-muted">Total followers</p>
                                    </div>
                                    <div class="ml-auto">
                                        <h2 class="counter text-success">{{0}}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Info box -->
            <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Most View News</h5>
                                <div class="table-responsive">
                                    <table class="table product-overview">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Title</th>
                                                <th>Categories</th>
                                                <th>Publish_Date</th>
                                                <th>Views</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($popularNews)>0)
                                            @foreach($popularNews as $show_news)
                                            <tr>
                                            <td><img src="{{asset('upload/images/thumb_img/'.$show_news->source_path)}}" width="50"></td>
                                                <td><a href="{{route('newsDetails', [$show_news->getCategory->cat_slug_en, $show_news->id])}}" target="_blank">{{Str::limit($show_news->news_title, 20)}}</a> </td>
                                                <td>{{$show_news->category_bd}} <br/>
                                                    {{$show_news->subcategory_bd}}
                                                </td>
                                              
                                                <td>
                                                    {{Carbon\Carbon::parse($show_news->publish_date)->format('d M, Y')}}
                                                </td>
                                                <td> {{$show_news->view_counts}}</td>
                                            </tr>
                                           @endforeach
                                        @else <tr><td colspan="8"> <h1>No news found.</h1></td></tr> @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Recent News</h5>
                                <div class="table-responsive">
                                    <table class="table product-overview">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th>Title</th>
                                                <th>Categories</th>
                                                <th>Publish_Date</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($recentNewses)>0)
                                            @foreach($recentNewses as $recentNews)
                                            <tr>
                                            <td><img src="{{asset('upload/images/thumb_img/'.$recentNews->source_path)}}" width="50"></td>
                                                <td><a href="{{route('newsDetails', [$recentNews->getCategory->cat_slug_en, $recentNews->id])}}" target="_blank">{{($recentNews->news_title)}}</a> </td>
                                                <td>{{$recentNews->category_bd}} <br/>
                                                    {{$recentNews->subcategory_bd}}
                                                </td>
                                              
                                                <td>
                                                    {{Carbon\Carbon::parse($recentNews->publish_date)->format('d M, Y')}}
                                                </td>
                                                <td>
                                                    @if($recentNews->status != 'pending')
                                                        <span class="label label-info">{{$recentNews->status}} </span>
                                                    @else
                                                        <span class="label label-warning">{{$recentNews->status}} </span>
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                           @endforeach
                                        @else <tr><td colspan="8"> <h1>No news found.</h1></td></tr> @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->


@endsection

@section('js')
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--morris JavaScript -->
    <script src="{{ asset('backend/assets/node_modules') }}/raphael/raphael-min.js"></script>
    <script src="{{ asset('backend/assets/node_modules') }}/morrisjs/morris.min.js"></script>
    <script src="{{ asset('backend/assets/node_modules') }}/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- Popup message jquery -->
    <script src="{{ asset('backend/assets/node_modules') }}/toast-master/js/jquery.toast.js"></script>
    <!-- Chart JS -->
    <script src="{{ asset('backend/js') }}/dashboard1.js"></script>
@endsection


