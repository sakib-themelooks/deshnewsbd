@extends('backend.layouts.master')
@section('title', 'Add page')
@section('css')
     <link href="{{asset('backend/assets')}}/node_modules/summernote/dist/summernote-bs4.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets')}}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
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
                    <h4 class="text-themecolor">Add Page </h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="{{route('page.list')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Page List</a>
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
                    <form action="{{route('page.store')}}" enctype="multipart/form-data" method="post" id="page">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="page_name_bd">Page Name Bangla</label>
                                                <input type="text" value="{{old('page_name_bd')}}"  required="required" name="page_name_bd"  id="page_name_bd" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="page_name_en">Page Name Enlish</label>
                                                <input type="text" value="{{old('page_name_en')}}"  required="required" name="page_name_en"  id="page_name_en" class="form-control" >
                                            </div>
                                        </div>
                                       <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="background: #fff;top:-10px;z-index: 1" for="mymce">Page Description</label>
                                                <textarea name="page_dsc" class="form-control summernote" rows="5">{{old('page_dsc')}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            
                                            <div class="form-group">
                                                <span class="required" for="meta_title">Meta Title</span>
                                                <input type="text" value="{{old('meta_title')}}"  name="meta_title" id="meta_title" placeholder = 'Enter meta title'class="form-control" >
                                            </div>
                                          
                                            <div class="form-group">
                                                <span class="required">Meta keywords( <span style="font-size: 12px;color: #777;font-weight: initial;">Write meta keywords Separated by Comma[,]</span> )</span>

                                                 <div class="tags-default">
                                                    <input class="form-control" type="text" name="keywords[]"  data-role="tagsinput" placeholder="Enter meta keywords" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <span class="control-label" for="meta_description">Meta Description</span>
                                                <textarea class="form-control" name="meta_description" id="meta_description" rows="2" style="resize: vertical;" placeholder="Enter Meta Description">{{old('meta_description')}}</textarea>
                                            </div>

                                       
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="template">Select Template</label>
                                                <select name="template"  required="required" id="template" class="form-control custom-select">
                                                    <option value="1" {{ (old('template') ==1) ? 'selected' : '' }}>Default Page</option>
                                                    <option value="2" {{ (old('template') ==2) ? 'selected' : '' }}>All News</option>
                                                     <option value="3" {{ (old('template') ==3) ? 'selected' : '' }}>Author List</option>
                                                    <option value="4" {{ (old('template') ==4) ? 'selected' : '' }}>Sitemap</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="menu">Menu</label>
                                                <select name="menu"  required="required" id="menu" class="form-control custom-select">
                                                    <option value="all">All</option>
                                                    <option value="1" {{ (old('menu') ==1) ? 'selected' : '' }}> Header Top</option>
                                                    <option value="2" {{ (old('menu') ==2) ? 'selected' : '' }}>Main Menu</option>
                                                    <option value="3" {{ (old('menu') ==3) ? 'selected' : '' }}>Footer Menu</option>
                                                </select>
                                            </div>
                                        </div>
         
                                        <div class="col-md-12">
                                            <div class="head-label">
                                                <span class="dropify_image_area">Add Images</span>
                                                <div class="form-group">
                                                    <input type="file" name="images" id="input-file-now" class="dropify" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12" style="padding: 20px 12px;">
                                            <div class="head-label">
                                                <label class="dropify_image_area" style="top:-12px;">Activation Status</label>
                                                <div  style="padding:0px 1px 30px 40px;">
                                                    <div class="custom-control custom-switch">
                                                      <input name="status"  {{ (old('status') == 'on') ? 'checked' : '' }} type="checkbox" class="custom-control-input" id="status">
                                                      <label style="padding: 8px 15px;" class="custom-control-label" for="status">Active/DeActive</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Create page</button>

                                <button type="reset" class="btn waves-effect waves-light btn-secondary">Cancel</button>
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
    <script src="{{asset('backend/assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

    });
    </script>


    <script src="{{asset('backend/assets')}}/node_modules/summernote/dist/summernote-bs4.min.js"></script>
    <script>
    $(function() {

        $('.summernote').summernote({
            height: 100, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });

        $('.inline-editor').summernote({
            airMode: true
        });

    });

    window.edit = function() {
        $(".click2edit").summernote()
    },
    window.save = function() {
        $(".click2edit").summernote('destroy');
    }

    </script>


@endsection

