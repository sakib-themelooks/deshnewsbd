@extends('backend.layouts.master')
@section('title', "Dashboard")
@section('css')
    <!-- chartist CSS -->
    <link href="{{asset('backend')}}/assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <!-- Dashboard 1 Page CSS -->
    <link href="{{asset('backend')}}/css/pages/dashboard1.css" rel="stylesheet">
    <style>
        .modal-dialog {
    max-width: 700px;
    margin: 1.75rem auto;
}
p {
    color: black;
    font-size: 16px;
}
.card {
    padding: 10px;
}
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
                                        <h2 class="counter text-primary"><a href="{{route('news.list')}}">{{$news}}</a></h2>
                                    </div>
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
                                        <h3><i class="fa fa-hourglass-half"></i></h3>
                                        <p class="text-muted">TOTAL PENDING</p>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="{{route('news.list', 'pending')}}"><h2 class="counter text-cyan">{{$pending_news}}</h2></a>
                                    </div>
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
                                        <h3><i class="fa fa-users"></i></h3>
                                        <p class="text-muted">TOTAL REPORTERS</p>
                                    </div>
                                    <div class="ml-auto">
                                        <h2 class="counter text-purple"><a href="{{route('reporter.list')}}">{{$reporters}}</a></h2>
                                    </div>
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
                                        <h3><i class="fa fa-user"></i></h3>
                                        <p class="text-muted">Total Users</p>
                                    </div>
                                    <div class="ml-auto">
                                        <h2 class="counter text-success"><a href="{{route('admin.user.list')}}">{{$user}}</a></h2>
                                    </div>
                                </div>
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


