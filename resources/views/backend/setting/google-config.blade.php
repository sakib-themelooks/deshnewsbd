@extends('backend.layouts.master')
@section('title', 'Google Analytics & Adsense')
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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Google</a></li>
                            <li class="breadcrumb-item active">Analytics & Adsense</li>
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
                                <div class="title_head"> Lang % Body n Header code</div>
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active " data-toggle="tab" href="#analytics" role="tab"><span class="hidden-sm-up"><i class="ti-stats-up"></i></span> <span class="hidden-xs-down">Lang % Body n Header code</span></a> </li>
                                   
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content tabcontent-border">
                                    <div class="tab-pane  active " id="analytics" role="tabpanel">
                                        <div class="p-20">
                                            <form action="{{route('googleSetting')}}" method="post" data-parsley-validate id="analytics">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ config('siteSetting.id') }}">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label class="col-md-12 col-form-label" for="google_analytics">Header code</label>
                                                            <div class="col-md-12">
                                                                <textarea rows="5" placeholder="Enter header code" name="google_analytics" id="google_analytics" class="form-control" >{!! config('siteSetting.google_analytics') !!}</textarea>
                                                            </div> 
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label class="col-md-12 col-form-label" for="google_adsense">Body code</label>
                                                            <div class="col-md-12">
                                                                <textarea rows="5" placeholder="Enter Body code" name="google_adsense" id="google_adsense" class="form-control">{!! config('siteSetting.google_adsense') !!}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row col-md-6"> 
                                                            <label class="col-md-4 text-right">Dashboard</label>
                                                            <div class="col-md-8">
                                                                <input type="text" value="{{$siteSetting->lang7}}" name="lang7" id="lang7" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row col-md-6"> 
                                                            <label class="col-md-4 text-right">Homepage Setting</label>
                                                            <div class="col-md-8">
                                                                <input type="text" value="{{$siteSetting->lang6}}" name="lang6" id="lang6" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row col-md-6"> 
                                                            <label class="col-md-4 text-right">News Section</label>
                                                            <div class="col-md-8">
                                                                <input type="text" value="{{$siteSetting->lang5}}" name="lang5" id="lang5" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row col-md-6"> 
                                                            <label class="col-md-4 text-right">Create News</label>
                                                            <div class="col-md-8">
                                                                <input type="text" value="{{$siteSetting->lang1}}" name="lang1" id="lang1" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row col-md-6"> 
                                                            <label class="col-md-4 text-right">All News</label>
                                                            <div class="col-md-8">
                                                                <input type="text" value="{{$siteSetting->lang2}}" name="lang2" id="lang2" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row col-md-6"> 
                                                            <label class="col-md-4 text-right">Pending News</label>
                                                            <div class="col-md-8">
                                                                <input type="text" value="{{$siteSetting->lang3}}" name="lang3" id="lang3" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row col-md-6"> 
                                                            <label class="col-md-4 text-right">Draft News</label>
                                                            <div class="col-md-8">
                                                                <input type="text" value="{{$siteSetting->lang4}}" name="lang4" id="lang4" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row col-md-6"> 
                                                            <label class="col-md-4 text-right">Category</label>
                                                            <div class="col-md-8">
                                                                <input type="text" value="{{$siteSetting->lang8}}" name="lang8" id="lang8" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row col-md-6"> 
                                                            <label class="col-md-4 text-right">Category List</label>
                                                            <div class="col-md-8">
                                                                <input type="text" value="{{$siteSetting->lang9}}" name="lang9" id="lang9" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row col-md-6"> 
                                                            <label class="col-md-4 text-right">Subcategory List</label>
                                                            <div class="col-md-8">
                                                                <input type="text" value="{{$siteSetting->lang10}}" name="lang10" id="lang10" class="form-control" >
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group row col-md-6"> 
                                                            <label class="col-md-4 text-right">State</label>
                                                            <div class="col-md-8">
                                                                <input type="text" value="{{$siteSetting->lang11}}" name="lang11" id="lang11" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row col-md-6"> 
                                                            <label class="col-md-4 text-right">Add City</label>
                                                            <div class="col-md-8">
                                                                <input type="text" value="{{$siteSetting->lang12}}" name="lang12" id="lang12" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row col-md-6"> 
                                                            <label class="col-md-4 text-right">Add Sub-City</label>
                                                            <div class="col-md-8">
                                                                <input type="text" value="{{$siteSetting->lang13}}" name="lang13" id="lang13" class="form-control" >
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group row col-md-6"> 
                                                            <label class="col-md-4 text-right">Media Gallery</label>
                                                            <div class="col-md-8">
                                                                <input type="text" value="{{$siteSetting->lang14}}" name="lang14" id="lang14" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row col-md-6"> 
                                                            <label class="col-md-4 text-right">Photo Gallery</label>
                                                            <div class="col-md-8">
                                                                <input type="text" value="{{$siteSetting->lang15}}" name="lang15" id="lang15" class="form-control" >
                                                            </div>
                                                        </div>
                                                        <div class="form-group row col-md-6"> 
                                                            <label class="col-md-4 text-right">Video Gallery</label>
                                                            <div class="col-md-8">
                                                                <input type="text" value="{{$siteSetting->lang16}}" name="lang16" id="lang16" class="form-control" >
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                    </div><hr>
                                                    <div class="form-actions pull-right">
                                                        <button type="submit" name="googleSettingTab" value="analytics" class="btn btn-success"> <i class="fa fa-save"></i> Update Google Setting</button>
                                                       
                                                        <button type="reset" class="btn waves-effect waves-light btn-secondary">Reset</button>
                                                    </div>
                                                </div>
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
