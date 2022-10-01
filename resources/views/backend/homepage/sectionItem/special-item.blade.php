@extends('backend.layouts.master')
@section('title', $section->title)

@section('css-top')
    <link href="{{asset('backend/assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets')}}/node_modules/jquery-asColorPicker-master/dist/css/asColorPicker.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets')}}/node_modules/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
@endsection
@section('css')
    <link href="{{asset('backend/assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .dropify-wrapper{height: 120px;}
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
                        <h4 class="text-themecolor">{{$section->title}} List</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">{{$section->title}}</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                            <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Add New Item</button>
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
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">
                                 <i class="drag-drop-info">Drag & drop sorting position</i>
                                <div class="table-responsive">
                                    <table  class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Sub Title</th>
                                                <th>Image</th>
                                                <th>Link</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="positionSorting" data-table="homepage_section_items">
                                            @foreach($sectionItems as $item)
                                            <tr style="background:{{$item->background_color}};color: {{$item->text_color}}" id="item{{$item->id}}">
                                                <td>
                                                    {{$item->item_title}}
                                                   
                                                </td>
                                                <td>{{$item->item_sub_title}}</td>
                                                <td> <img src="{{ asset('upload/images/homepage/'.$item->thumb_image) }} " width="40" alt=""></td>
                                                <td>{{$item->custom_url}}</td>
                                                <td>
                                                    <div class="custom-control custom-switch" style="padding-left: 3.25rem;">
                                                      <input name="status" onclick="satusActiveDeactive('homepage_section_items', {{$item->id}})"  type="checkbox" {{($item->status == 1) ? 'checked' : ''}} class="custom-control-input" id="status{{$item->id}}">
                                                      <label class="custom-control-label" for="status{{$item->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" onclick="edit('{{$item->id}}')"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button>
                                                    @if($item->is_default != 1)
                                                    <button title="Delete" data-target="#delete" onclick="deleteConfirmPopup('{{route("admin.homepageSectionItem.remove", $item->id)}}')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> </button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->

        <!-- update Modal -->
        <div class="modal fade" id="edit" role="dialog" style="display: none;">
            <div class="modal-dialog">
                <form action="{{route('admin.homepageSectionItem.update')}}" data-parsley-validate method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update {{$section->title}}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row" id="edit_form"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-success">Update</button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
        <!-- add Modal -->
        <div class="modal fade" id="add">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create {{$section->title}}</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                            <form action="{{route('admin.homepageSectionItem.store')}}" method="POST" enctype="multipart/form-data" data-parsley-validate>
                                {{csrf_field()}}
                                <input type="hidden" value="{{$section->id}}" name="section_id">
                                <input type="hidden" value="{{$section->section_type}}" name="section_type">
                                <div class="form-body">
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group"> 
                                                <label class="dropify_image">Icon</label>
                                                <input type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner9" id="input-file-events">
                                                <i class="info">Requirement size: any</i>
                                            </div>
                                            @if ($errors->has('banner9'))
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $errors->first('banner9') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label for="name">Section Title</label>
                                                <input required placeholder="Enter Title" name="item_title" id="name" value="{{old('item_title')}}" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="sub_title">Sub Title</label>
                                                <input name="item_sub_title" placeholder="Enter sub title" id="sub_title" value="{{old('item_sub_title')}}" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group"> 
                                                <label class="dropify_image">Image</label>
                                                <input type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner1" id="input-file-events">
                                                <i class="info">Requirement size: any</i>
                                            </div>
                                            @if ($errors->has('banner1'))
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $errors->first('banner1') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group"> 
                                                <label class="dropify_image">Image</label>
                                                <input type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner2" id="input-file-events">
                                                <i class="info">Requirement size: any</i>
                                            </div>
                                            @if ($errors->has('banner2'))
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $errors->first('banner2') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group"> 
                                                <label class="dropify_image">Image</label>
                                                <input type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner3" id="input-file-events">
                                                <i class="info">Requirement size: any</i>
                                            </div>
                                            @if ($errors->has('banner3'))
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $errors->first('banner3') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group"> 
                                                <label class="dropify_image">Image</label>
                                                <input type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner4" id="input-file-events">
                                                <i class="info">Requirement size: any</i>
                                            </div>
                                            @if ($errors->has('banner4'))
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $errors->first('banner4') }}
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name1">Title</label>
                                                <input placeholder="Enter Title" name="name1" id="name1" value="{{old('name1')}}" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Sub Title</label>
                                                <input name="subname1" placeholder="Enter sub title" id="subname1" value="{{old('subname1')}}" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="link1">Link</label>
                                                <input name="link1" placeholder="Enter link" class="form-control" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name2">Title</label>
                                                <input placeholder="Enter Title" name="name2" id="name2" value="{{old('name2')}}" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="subname2">Sub Title</label>
                                                <input name="subname2" placeholder="Enter sub title" id="subname2" value="{{old('subname2')}}" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="link2">Link</label>
                                                <input name="link2" placeholder="Enter link" class="form-control" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name3">Title</label>
                                                <input placeholder="Enter Title" name="name3" id="name3" value="{{old('name3')}}" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="subname3">Sub Title</label>
                                                <input name="subname3" placeholder="Enter sub title" id="subname3" value="{{old('subname3')}}" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="link3">Link</label>
                                                <input name="link3" placeholder="Enter link" class="form-control" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name4">Title</label>
                                                <input placeholder="Enter Title" name="name4" id="name4" value="{{old('name4')}}" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="subname4">Sub Title</label>
                                                <input name="subname4" placeholder="Enter sub title" id="subname4" value="{{old('subname4')}}" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="link4">Link</label>
                                                <input name="link4" placeholder="Enter link" class="form-control" >
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        <div class="col-md-3">
                                            <div class="form-group"> 
                                                <label class="dropify_image">Image</label>
                                                <input type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner5" id="input-file-events">
                                                <i class="info">Requirement size: any</i>
                                            </div>
                                            @if ($errors->has('banner5'))
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $errors->first('banner5') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group"> 
                                                <label class="dropify_image">Image</label>
                                                <input type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner6" id="input-file-events">
                                                <i class="info">Requirement size: any</i>
                                            </div>
                                            @if ($errors->has('banner6'))
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $errors->first('banner6') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group"> 
                                                <label class="dropify_image">Image</label>
                                                <input type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner7" id="input-file-events">
                                                <i class="info">Requirement size: any</i>
                                            </div>
                                            @if ($errors->has('banner7'))
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $errors->first('banner7') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group"> 
                                                <label class="dropify_image">Image</label>
                                                <input type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner8" id="input-file-events">
                                                <i class="info">Requirement size: any</i>
                                            </div>
                                            @if ($errors->has('banner8'))
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $errors->first('banner8') }}
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name5">Title</label>
                                                <input placeholder="Enter Title" name="name5" id="name5" value="{{old('name5')}}" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="subname5">Sub Title</label>
                                                <input name="subname5" placeholder="Enter sub title" id="subname5" value="{{old('subname5')}}" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="link5">Link</label>
                                                <input name="link5" placeholder="Enter link" class="form-control" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name6">Title</label>
                                                <input placeholder="Enter Title" name="name6" id="name6" value="{{old('name6')}}" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="subname6">Sub Title</label>
                                                <input name="subname6" placeholder="Enter sub title" id="subname6" value="{{old('subname6')}}" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="link6">Link</label>
                                                <input name="link6" placeholder="Enter link" class="form-control" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name7">Title</label>
                                                <input placeholder="Enter Title" name="name7" id="name7" value="{{old('name7')}}" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="subname7">Sub Title</label>
                                                <input name="subname7" placeholder="Enter sub title" id="subname7" value="{{old('subname7')}}" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="link7">Link</label>
                                                <input name="link7" placeholder="Enter link" class="form-control" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name8">Title</label>
                                                <input placeholder="Enter Title" name="name8" id="name8" value="{{old('name8')}}" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="subname8">Sub Title</label>
                                                <input name="subname8" placeholder="Enter sub title" id="subname8" value="{{old('subname8')}}" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="link8">Link</label>
                                                <input name="link8" placeholder="Enter link" class="form-control" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="head-label">
                                                <label class="switch-box">Status</label>
                                                <div  class="status-btn" >
                                                    <div class="custom-control custom-switch">
                                                        <input name="status" checked  type="checkbox" class="custom-control-input" {{ (old('status') == 'on') ? 'checked' : '' }} id="status">
                                                        <label  class="custom-control-label" for="status">Publish/UnPublish</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row justify-content-md-center">
                                        <div class="col-md-12">
                                            <div class="modal-footer">
                                                <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                                <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- delete Modal -->
        @include('backend.modal.delete-modal')

@endsection
@section('js')
    
    <script src="{{asset('backend/assets')}}/node_modules/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
     <script type="text/javascript" src="{{asset('backend/assets')}}/node_modules/multiselect/js/jquery.multi-select.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="{{asset('backend/assets')}}/node_modules/jquery-asColor/dist/jquery-asColor.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <script>

    // Colorpicker
  
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });

    $(".select2").select2();
    </script>

    <script src="{{asset('backend/assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
       
    });
    </script>
    <script type="text/javascript">

    function edit(id){
        $('#edit_form').html('<div class="loadingData"></div>');
        var  url = '{{route("admin.homepageSectionItem.edit", ":id")}}';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#edit_form").html(data);
                    $(".select2").select2();
                     $('.dropify').dropify();
                    $(".gradient-colorpicker").asColorPicker({
                        mode: 'gradient'
                    });
                }
            },
            // $ID Error display id name
            @include('common.ajaxError', ['ID' => 'edit_form'])
        });

    }

   

        // if occur error open model
        @if($errors->any())
            $("#{{Session::get('submitType')}}").modal('show');
        @endif
    </script>

@endsection
