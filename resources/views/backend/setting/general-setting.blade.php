@extends('backend.layouts.master')
@section('title', 'General Setting')
@section('css-top')
<link href="{{asset('backend/assets')}}/node_modules/jquery-asColorPicker-master/dist/css/asColorPicker.css"
    rel="stylesheet" type="text/css" />
@endsection
@section('css')

<link href="{{asset('backend/css')}}/pages/tab-page.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    #generalSetting input,
    #generalSetting textarea {
        color: #797878 !important
    }

    .asColorPicker_open {
        z-index: 9999999;
        border: 1px solid #ccc;
    }
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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">General</a></li>
                        <li class="breadcrumb-item active">Setting</li>
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
                        <div class="title_head"> General Setting </div>
                        <h6 class="card-subtitle">Set the basic configuration settings for your site.</h6>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"> <a class="nav-link  active" data-toggle="tab" href="#generalSetting"
                                    role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span
                                        class="hidden-xs-down">General Setting</span></a> </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border">
                            <div class="tab-pane active" id="generalSetting" role="tabpanel">
                                <div class="p-20">
                                    <form action="{{route('generalSettingUpdate', $setting->id)}}" method="post"
                                        data-parsley-validate id="generalSetting">
                                        @csrf
                                        <div class="form-body">

                                            <div class="">
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label required"
                                                        for="site_name">Site Name</label>
                                                    <div class="col-md-2">
                                                        <input type="text" value="{{$setting->site_name}}"
                                                            placeholder="Enter site name" name="site_name" required=""
                                                            id="site_name" class="form-control">
                                                    </div>

                                                    <label class="col-md-2 text-right col-form-label"
                                                        for="site_owner">Chief Editor</label>
                                                    <div class="col-md-2">
                                                        <input type="text" value="{{$setting->site_owner}}"
                                                            placeholder="Enter site Chief Editor" name="site_owner"
                                                            id="site_owner" class="form-control">
                                                    </div>
                                                    <label class="col-md-1 text-right col-form-label"
                                                        for="site_owner">Co-editor</label>
                                                    <div class="col-md-2">
                                                        <input type="text" value="{{$setting->site_owners}}"
                                                            placeholder="Enter site Co-editor" name="site_owners"
                                                            id="site_owners" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label required"
                                                        for="phone">Phone</label>
                                                    <div class="col-md-3">
                                                        <input type="text" value="{{$setting->phone}}"
                                                            placeholder="Enter phone number" name="phone" required=""
                                                            id="phone" class="form-control">
                                                    </div>

                                                    <label class="col-md-2 text-right col-form-label required"
                                                        for="email">Email</label>
                                                    <div class="col-md-3">
                                                        <input type="text" value="{{$setting->email}}"
                                                            placeholder="Enter email number" name="email" required=""
                                                            id="email" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group row">

                                                    <label class="col-md-2 text-right col-form-label"
                                                        for="currency">Font Name</label>
                                                    <div class="col-md-3">
                                                        <input type="text" value="{{$setting->currency}}"
                                                            placeholder="Enter currency" name="currency" required=""
                                                            id="currency" class="form-control">
                                                    </div>
                                                    <label class="col-md-2 text-right col-form-label"
                                                        for="currency_symble">Currency Symble</label>
                                                    <div class="col-md-3">
                                                        <input type="text" value="{{$setting->currency_symble}}"
                                                            placeholder="Enter Symble" name="currency_symble"
                                                            required="" id="currency_symble" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label required"
                                                        for="date_format ">Date Format</label>
                                                    <div class="col-md-2">
                                                        <select class="form-control custom-select" name="date_format"
                                                            id="date_format" required="required">
                                                            <option value="{{$setting->date_format}}">
                                                                {{Carbon\Carbon::parse(now())->format($setting->date_format)}}
                                                            </option>
                                                            <option value="Y-m-d">
                                                                {{Carbon\Carbon::parse(now())->format('Y-m-d')}}
                                                            </option>
                                                            <option value="d-m-Y">
                                                                {{Carbon\Carbon::parse(now())->format('d-m-Y')}}
                                                            </option>
                                                            <option value="d/m/Y">
                                                                {{Carbon\Carbon::parse(now())->format('d/m/Y')}}
                                                            </option>
                                                            <option value="m/d/Y">
                                                                {{Carbon\Carbon::parse(now())->format('m/d/Y')}}
                                                            </option>
                                                            <option value="m.d.Y">
                                                                {{Carbon\Carbon::parse(now())->format('m.d.Y')}}
                                                            </option>
                                                            <option value="j, n, Y">
                                                                {{Carbon\Carbon::parse(now())->format('j, n, Y')}}
                                                            </option>
                                                            <option value="F j, Y">
                                                                {{Carbon\Carbon::parse(now())->format('F j, Y')}}
                                                            </option>
                                                            <option value="M j, Y">
                                                                {{Carbon\Carbon::parse(now())->format('M j, Y')}}
                                                            </option>
                                                            <option value="j M, Y">
                                                                {{Carbon\Carbon::parse(now())->format('j M, Y')}}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <label class="col-md-1 text-right col-form-label" for="bg_color">BG
                                                        color</label>
                                                    <div class="col-md-2">
                                                        <input name="bg_color"
                                                            value="{{ ($setting->bg_color) ? $setting->bg_color : '#fff' }}"
                                                            type="text" value="#fff"
                                                            class="gradient-colorpicker form-control ">
                                                    </div>

                                                    <label class="col-md-1 text-right col-form-label"
                                                        for="text_color">Text color</label>
                                                    <div class="col-md-2">
                                                        <input name="text_color" value="{{ $setting->text_color }}"
                                                            class="gradient-colorpicker form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        for="lazyload ">Lazyload</label>
                                                    <div class="col-md-2">
                                                        <select class="form-control custom-select" name="lazyload"
                                                            id="lazyload">
                                                            <option value="on" @if($setting->lazyload == 'on') selected
                                                                @endif>On</option>
                                                            <option value="" @if($setting->lazyload == '') selected
                                                                @endif>Off</option>
                                                        </select>
                                                    </div>

                                                    <label class="col-md-2 text-right col-form-label"
                                                        for="lazyload ">Homepage</label>
                                                    <div class="col-md-2">
                                                        @php $pages = App\Models\Page::where('status', 1)->get();
                                                        @endphp
                                                        <select class="form-control custom-select" name="homepage"
                                                            id="homepage">
                                                            <option value="">Select page</option>
                                                            @foreach($pages as $page)
                                                            <option value="{{$page->page_slug}}" @if($setting->homepage
                                                                == $page->page_slug) selected
                                                                @endif>{{$page->page_name_bd}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1"
                                                        for="about">About</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="Write about" name="about"
                                                            class=" form-control"
                                                            id="about">{{$setting->about}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1"
                                                        for="address">Office Address</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2"
                                                            placeholder="Exm. House, Road, Uttara, Dhaka, Bangladesh"
                                                            name="address" class=" form-control"
                                                            id="address">{{$setting->address}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1"
                                                        for="address">Trending</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="trending tag" name="trending"
                                                            class=" form-control"
                                                            id="trending">{{$setting->trending}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="code1">Header
                                                        Top</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code1"
                                                            class="form-control"
                                                            id="code1">{{$setting->code1}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="code2">Header
                                                        1</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code2"
                                                            class="form-control"
                                                            id="code2">{{$setting->code2}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="code3">Header
                                                        2</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code3"
                                                            class="form-control"
                                                            id="code3">{{$setting->code3}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="code4">Header
                                                        bottom</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code4"
                                                            class="form-control"
                                                            id="code4">{{$setting->code4}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1"
                                                        for="code5">Category top</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code5"
                                                            class="form-control"
                                                            id="code5">{{$setting->code5}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1"
                                                        for="code6">Category page 1</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code6"
                                                            class="form-control"
                                                            id="code6">{{$setting->code6}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1"
                                                        for="code7">Category page 2</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code7"
                                                            class="form-control"
                                                            id="code7">{{$setting->code7}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1"
                                                        for="code8">Category post Left 1</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code8"
                                                            class="form-control"
                                                            id="code8">{{$setting->code8}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1"
                                                        for="code9">Category post Left 1</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code9"
                                                            class="form-control"
                                                            id="code9">{{$setting->code9}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1"
                                                        for="code10">Category right 1</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code10"
                                                            class="form-control"
                                                            id="code10">{{$setting->code10}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1"
                                                        for="code11">Category right 2</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code11"
                                                            class="form-control"
                                                            id="code11">{{$setting->code11}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1"
                                                        for="code12">Category bottom</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code12"
                                                            class="form-control"
                                                            id="code12">{{$setting->code12}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="code13">News
                                                        top</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code13"
                                                            class="form-control"
                                                            id="code13">{{$setting->code13}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="code14">News
                                                        title top</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code14"
                                                            class="form-control"
                                                            id="code14">{{$setting->code14}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="code15">News
                                                        title bottom</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code15"
                                                            class="form-control"
                                                            id="code15">{{$setting->code15}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="code16">News
                                                        Photo bottom</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code16"
                                                            class="form-control"
                                                            id="code16">{{$setting->code16}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="code17">News
                                                        dec bottom</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code17"
                                                            class="form-control"
                                                            id="code17">{{$setting->code17}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="code18">News
                                                        comments</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code18"
                                                            class="form-control"
                                                            id="code18">{{$setting->code18}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="code19">more
                                                        news 1</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code19"
                                                            class="form-control"
                                                            id="code19">{{$setting->code19}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="code20">more
                                                        news 2</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code20"
                                                            class="form-control"
                                                            id="code20">{{$setting->code20}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="code21">News
                                                        right Top</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code21"
                                                            class="form-control"
                                                            id="code21">{{$setting->code21}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="code22">News
                                                        right bottom</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="code22"
                                                            class="form-control"
                                                            id="code22">{{$setting->code22}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post1">post
                                                        1</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post1"
                                                            class="form-control"
                                                            id="post1">{{$setting->post1}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post2">post
                                                        2</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post2"
                                                            class="form-control"
                                                            id="post2">{{$setting->post2}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post3">post
                                                        3</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post3"
                                                            class="form-control"
                                                            id="post3">{{$setting->post3}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post4">post
                                                        4</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post4"
                                                            class="form-control"
                                                            id="post4">{{$setting->post4}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post5">post
                                                        5</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post5"
                                                            class="form-control"
                                                            id="post5">{{$setting->post5}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post6">post
                                                        6</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post6"
                                                            class="form-control"
                                                            id="post6">{{$setting->post6}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post7">post
                                                        7</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post7"
                                                            class="form-control"
                                                            id="post7">{{$setting->post7}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post8">post
                                                        8</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post8"
                                                            class="form-control"
                                                            id="post8">{{$setting->post8}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post9">post
                                                        9</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post9"
                                                            class="form-control"
                                                            id="post9">{{$setting->post9}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post10">post
                                                        10</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post10"
                                                            class="form-control"
                                                            id="post10">{{$setting->post10}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post11">post
                                                        11</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post11"
                                                            class="form-control"
                                                            id="post11">{{$setting->post11}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post12">post
                                                        12</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post12"
                                                            class="form-control"
                                                            id="post12">{{$setting->post12}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post13">post
                                                        13</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post13"
                                                            class="form-control"
                                                            id="post13">{{$setting->post13}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post14">post
                                                        14</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post14"
                                                            class="form-control"
                                                            id="post14">{{$setting->post14}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post15">post
                                                        15</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post15"
                                                            class="form-control"
                                                            id="post15">{{$setting->post15}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post16">post
                                                        16</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post16"
                                                            class="form-control"
                                                            id="post16">{{$setting->post16}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post17">post
                                                        17</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post17"
                                                            class="form-control"
                                                            id="post17">{{$setting->post17}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post18">post
                                                        18</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post18"
                                                            class="form-control"
                                                            id="post18">{{$setting->post18}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post19">post
                                                        19</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post19"
                                                            class="form-control"
                                                            id="post19">{{$setting->post19}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post20">post
                                                        20</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post20"
                                                            class="form-control"
                                                            id="post20">{{$setting->post20}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label class="col-md-2 text-right col-form-label"
                                                        style="background: #fff;top:-10px;z-index: 1" for="post20">post
                                                        20</label>
                                                    <div class="col-md-8">
                                                        <textarea rows="2" placeholder="html code" name="post20"
                                                            class="form-control"
                                                            id="post20">{{$setting->post20}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-actions pull-right">
                                            <button type="submit" name="updateTab" value="generalSetting"
                                                class="btn btn-success"> <i class="fa fa-save"></i> Update General
                                                Setting</button>

                                            <button type="reset"
                                                class="btn waves-effect waves-light btn-secondary">Reset</button>
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

@section('js')


<!-- Color Picker Plugin JavaScript -->
<script src="{{asset('backend/assets')}}/node_modules/jquery-asColor/dist/jquery-asColor.js"></script>
<script src="{{asset('backend/assets')}}/node_modules/jquery-asGradient/dist/jquery-asGradient.js"></script>
<script src="{{asset('backend/assets')}}/node_modules/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js">
</script>

<script>
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
   

</script>
@endsection