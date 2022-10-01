@extends('backend.layouts.master')
@section('title', 'Popular news count day')
@section('css')
    <link href="{{asset('backend/css')}}/pages/tab-page.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #generalSetting input, #generalSetting textarea{color: #797878!important}
    </style>
@endsection
@section('content')
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                
                <div class="col-md-12 align-self-center ">
                    <div class="d-fl ">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Popular </a></li>
                            <li class="breadcrumb-item active"> news count day</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="title_head"> News count day </div>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"> <a class="nav-link  active " data-toggle="tab" href="#popular_news_count_day" role="tab"><span class="hidden-sm-up">{{config('siteSetting.currency_symble')}} </span> <span class="hidden-xs-down">News count day</span></a> </li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                   
                                    <div class="tab-pane active" id="popular_news_count_day" role="tabpanel">
                                        <div class="p-20">
                                            <form action="{{ route('siteSettingUpdate') }}" method="post" >
		                                    @csrf
		                                    <input type="hidden" name="type" value="popular_news_count_day">
		                                    <div class="form-group">
                                                
		                                        <label class="required" for="title">Popular news count day</label><br/>
		                                        <input style="width: 300px" required="" name="value" id="title" value="{{ $popular_news_count_day->value }}" type="text" placeholder="Example .7" class="form-control">
		                                    </div>
                                            
		                                    <button type="submit" class="btn btn-info">Update</button>
		                                </form>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
@endsection
