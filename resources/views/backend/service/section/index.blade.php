@extends('backend.layouts.master')
@section('title', str_replace('-', ' ', Request::route('page_slug')).' section list')

@section('css-top')
    <link href="{{asset('backend/assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets')}}/node_modules/jquery-asColorPicker-master/dist/css/asColorPicker.css" rel="stylesheet" type="text/css" />

@endsection
@section('css')
<link href="{{asset('backend/assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .asColorPicker_open{z-index: 9999999}
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
                    <h4 class="text-themecolor">{{ str_replace('-', ' ', Request::route('page_slug'))}} section List</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="{{ url()->previous() }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                                    class="fa fa-angle-left"></i> Back </a>
                        <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Add New Section</button>
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
                                            <th>#</th>
                                            <th>Section Title</th>
                                            <th>Section Sourch</th>
                                            <th>Number Of Item</th>
                                            <th>Section Width</th>
                                            <th>Is Default</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="positionSorting" data-table="homepage_sections">
                                        @foreach($homepageSections as $index => $data)
                                        <tr style="background:{{$data->background_color}};" id="item{{$data->id}}">
                                            <td>{{$index+1}}</td>
                                            <td>{{$data->title}}</td>
                                            <td>{{str_replace('-', ' ', $data->section_type)}}</td>
                                            <td>{{ $data->item_number }}</td>
                                            <td><span class="label label-info"> {{($data->layout_width != null) ? 'Full' : 'Box'}}</span>
                                            </td>
                                            <td>{!!($data->is_default == 1) ? '<span class="label label-info"> Default</span>' : '<span class="label label-danger">Custom</span>' !!}
                                            </td>
                                            <td>
                                                <div class="custom-control custom-switch" style="padding-left: 3.25rem;">
                                                  <input name="status" onclick="satusActiveDeactive('homepage_sections', {{$data->id}})"  type="checkbox" {{($data->status == 1) ? 'checked' : ''}} class="custom-control-input" id="status{{$data->id}}">
                                                  <label class="custom-control-label" for="status{{$data->id}}"></label>
                                                </div>
                                            </td>
                                            <td>
                                                @if($data->section_manage == 1)
                                                <a title="Add item under this section" class="btn btn-primary btn-sm" href="{{route('admin.homepageSectionItem', $data->slug)}}"><i class="ti-pin-alt" aria-hidden="true"></i> Manage {{$data->section_type}}</a>
                                                @endif

                                                <button type="button" onclick="edit('{{$data->id}}')"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button>
                                               
                                                @if($data->is_default != 1)
                                                <button title="Delete" data-target="#delete" onclick="deleteConfirmPopup('{{route("admin.pageSection.delete", $data->id)}}')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button>
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
            <form action="{{route('admin.pageSection.update')}}" enctype="multipart/form-data" method="post">
                  {{ csrf_field() }}
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update section</h4>
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
                    <h4 class="modal-title">Create section</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body form-row">
                    <div class="card-body">
                        <form action="{{route('admin.pageSection.store')}}" enctype="multipart/form-data" data-parsley-validate  method="POST" >
                            {{csrf_field()}}
                            <input type="hidden" name="page_name" value="{{Request::route('page_slug')}}">
                            <div class="form-body">
                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label class="required" for="name">Section Title</label>
                                            <input  name="title" id="name" value="{{old('title')}}" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="display">Display</label>
                                            <select name="display" class="form-control">
                                                <option value="block">on</option>
                                                <option value="none">off</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name required">Select Sourch</label>
                                            <select required onchange="sectionType(this.value)" name="section_type" class="form-control">
                                                <option value="">Selct one</option>
                                                <option value="category">Categories</option>
                                                <option value="services">Services</option>
                                                <option value="banner">Banner</option>
                                                <option value="special-item">Special Item</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-12"><div class="row" id="showSection"></div></div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="required">Number Of Item</label>
                                            <input type="number" min="1" class="form-control" placeholder="Example: 7" name="item_number">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="required">Section Width</label>
                                            <select name="layout_width" class="form-control">
                                                <option value="box">Box</option>
                                                <option value="full">Full</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="required" for="name">Bacground Color</label>
                                            <input type="text" name="background_color" value="#ffffff" class="form-control gradient-colorpicker" >
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="required" for="name">Text Color</label>
                                            <input name="text_color" value="#000000" class="gradient-colorpicker form-control" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="required" for="text_bg">Text background Color</label>
                                            <input name="text_bg" value="#e8e7e7" class="gradient-colorpicker form-control" >
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group"> 
                                            <label class="dropify_image">Tumbnail Image</label>
                                            <input  type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="thumb_image" id="input-file-events">
                                            <i class="upload-info">Recommended size: 300px*250px</i>
                                        </div>
                                        @if ($errors->has('thumb_image'))
                                            <span class="invalid-feedback" role="alert">
                                                {{ $errors->first('thumb_image') }}
                                            </span>
                                        @endif
                                    </div>
                                    
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Image Position</label>
                                            <select name="image_position" class="form-control">
                                                <option value="left">Left</option>
                                                <option value="right">Right</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                   
                                </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-12">
                                        <div class="head-label">
                                            <label class="switch-box" style="margin-left: -12px; top:-12px;">Status</label>
                                            <div  class="status-btn" >
                                                <div class="custom-control custom-switch">
                                                    <input name="status" checked  type="checkbox" class="custom-control-input" {{ (old('status') == 'on') ? 'checked' : '' }} id="status">
                                                    <label  class="custom-control-label" for="status">Publish/UnPublish</label>
                                                </div>
                                            </div>
                                        </div>
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
    <script src="{{asset('backend/assets')}}/node_modules/jqueryui/jquery-ui.min.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="{{asset('backend/assets')}}/node_modules/jquery-asColor/dist/jquery-asColor.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>

    <script src="{{asset('backend/assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
    });
    </script>
    <script>
    // Colorpicker
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });

    $(".select2").select2();
    </script>
    <script>
      
        function removeImage(id){
            if ( confirm("Are you sure delete thumb image.?")) {
                var url = "{{route('sectionImageDelete', ':id')}}";
                url = url.replace(':id', id);
                $.ajax({
                    url:url,
                    method:"get",
                    success:function(data){
                        if(data){
                             $('.thumb_image').html('<input  type="file" class="dropify" accept="image/*" data-type="image" data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="thumb_image" id="input-file-events">');
                           
                            $('.dropify').dropify();
                            toastr.success(data.msg);
                        }
                    }
                }); 
            }
            return false;
        }

    </script>
    <script type="text/javascript">

    function sectionType(sectionType, edit=''){

        var output = '';
        if(sectionType== 'banner'){
            output = '<div class="col-md-12"><div class="form-group"> <label class="required" for="product_id">Select Banner</label> <select name="product_id" required="required" id="product_id" class="form-control custom-select"> <option value="">Select banner</option>@foreach($banners as $banner)<option value="{{$banner->id}}" > {{$banner->title}}</option>@endforeach</select> </div></div>';
        }else if(sectionType== 'services'){
            output = '<div class="col-md-12"><div class="form-group"> <label class="required" for="product_id">Services</label> <select name="product_id" required="required" id="product_id" class="form-control select2" custom-select"><option value="">Select service</option> @foreach($serviceTypes as $serviceType)  <option value="{{$serviceType->id}}">{{$serviceType->title}}</option>  @endforeach</select> </div></div>';

        }else if(sectionType== 'special-item'){
            output = '<div class="col-md-12"><div class="form-group"> <label class="required" for="special_item">Select special item</label> <select name="special_item" required="required" id="special_item" class="form-control select2" custom-select"><option value="special-item">Select item</option> @for($i=1; $i<=11; $i++)  <option value="special-item{{$i}}">Special Item {{$i}}</option>  @endfor</select> </div></div>';

        }else{

        }
        if(edit == 'edit'){
            $('#editshowSection').html(output);
            $('#showSection').html('');
             $(".select2").select2();
        }else{
            $('#showSection').html(output);
            $('#editshowSection').html('');
            $(".select2").select2();
        } 
    }

    function edit(id){
        $('#edit_form').html('<div class="loadingData"></div>');
        var  url = '{{route("admin.pageSection.edit", ":id")}}';
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
