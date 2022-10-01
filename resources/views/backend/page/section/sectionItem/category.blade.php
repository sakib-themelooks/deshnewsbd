@extends('backend.layouts.master')
@section('title', 'Category section list')

@section('css-top')
    <link href="{{asset('backend/assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets')}}/node_modules/jquery-asColorPicker-master/dist/css/asColorPicker.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets')}}/node_modules/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
@endsection
@section('css')
    <link href="{{asset('backend/assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .asColorPicker_open{z-index: 9999999}
       
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
                        <h4 class="text-themecolor">Category section List</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Category</a></li>
                                <li class="breadcrumb-item active">list</li>
                            </ol>
                            <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Add New</button>
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
                                                <th>Section Title</th>
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="positionSorting" data-table="homepage_section_items">
                                            @foreach($sectionItems as $data)
                                            <tr style="background:{{$data->background_color}};color: {{$data->text_color}}" id="item{{$data->id}}">
                                                <td>
                                                    {{$data->item_title}}
                                                    @if($data->item_sub_title)<p>{{$data->item_sub_title}}</p>@endif
                                                </td>
                                                <td>@if($data->category) {{$data->category->category_bd}} @endif</td>
                                                
                                               
                                                <td>
                                                    <div class="custom-control custom-switch" style="padding-left: 3.25rem;">
                                                      <input name="status" onclick="satusActiveDeactive('homepage_section_items', {{$data->id}})"  type="checkbox" {{($data->status == 1) ? 'checked' : ''}} class="custom-control-input" id="status{{$data->id}}">
                                                      <label class="custom-control-label" for="status{{$data->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" onclick="edit('{{$data->id}}')"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button>
                                                    @if($data->is_default != 1)
                                                    <button title="Delete" data-target="#delete" onclick="deleteConfirmPopup('{{route("admin.homepageSectionItem.remove", $data->id)}}')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> </button>
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
                <form action="{{route('admin.homepageSectionItem.update')}}" enctype="multipart/form-data" method="post">
                      {{ csrf_field() }}
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update category section</h4>
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
                        <h4 class="modal-title">Add category section</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body form-row">
                        <div class="card-body">
                            <form action="{{route('admin.homepageSectionItem.store')}}" enctype="multipart/form-data" method="POST" >
                                {{csrf_field()}}
                                <input type="hidden" value="{{$section->id}}" name="section_id">
                                 <input type="hidden" value="{{$section->section_type}}" name="section_type">
                                <div class="form-body">
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Section Title</label>
                                                <input placeholder="Enter Title" name="item_title" id="name" value="{{old('item_title')}}" required="" type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="icon">icon cloass</label>
                                                <input placeholder="Enter icon class" name="icon" id="icon" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="item_title_number">Style</label>
                                                <select required name="item_title_number" class="form-control">
                                                    @for($i=1; $i<=20; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="sub_title">Sub Title</label>
                                                <input  name="item_sub_title" placeholder="Enter sub title" id="sub_title" value="{{old('item_sub_title')}}" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="required" for="category_id">Select category</label>
                                                <select required name="category_id" id="category_id" class="select2 form-control custom-select">
                                                   <option value="">Select category</option>
                                                   @foreach($categories as $category)
                                                   <option value="{{$category->id}}">{{$category->category_bd}}</option>
                                                        @foreach($category->subcategories as $subcategory)
                                                           <option value="{{$subcategory->id}}">-{{$subcategory->category_bd}}</option>
                                                            @foreach($subcategory->subcategories as $childcategory)
                                                            <option value="{{$childcategory->id}}">--{{$childcategory->category_bd}}</option>
                                                            @endforeach
                                                        @endforeach
                                                   @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name required">Section Layout</label>
                                                <select required name="section_layout" class="form-control">
                                                    @for($i=1; $i<=12; $i++)
                                                    <option value="alo-{{$i}}">Alo {{$i}}</option>
                                                    @endfor
                                                    @for($i=1; $i<=20; $i++)
                                                    <option value="grid-{{$i}}">Modern Grid {{$i}}</option>
                                                    @endfor
                                                    @for($i=1; $i<=20; $i++)
                                                    <option value="mix-{{$i}}">Mix {{$i}}</option>
                                                    @endfor
                                                    @for($i=1; $i<=2; $i++)
                                                    <option value="gridlisting-{{$i}}">Grid Listing {{$i}}</option>
                                                    @endfor
                                                    @for($i=1; $i<=4; $i++)
                                                    <option value="blog-{{$i}}">Blog Listing {{$i}}</option>
                                                    @endfor
                                                    @for($i=1; $i<=10; $i++)
                                                    <option value="thumbnail-{{$i}}">Thumbnail Listing {{$i}}</option>
                                                    @endfor
                                                    @for($i=1; $i<=2; $i++)
                                                    <option value="text-{{$i}}">Text Listing {{$i}}</option>
                                                    @endfor
                                                    @for($i=1; $i<=2; $i++)
                                                    <option value="tall-{{$i}}">Tall Listing {{$i}}</option>
                                                    @endfor
                                                    @for($i=1; $i<=3; $i++)
                                                    <option value="slider-{{$i}}">Slider {{$i}}</option>
                                                    @endfor
                                                    @for($i=1; $i<=5; $i++)
                                                    <option value="scroll-{{$i}}">Scroll {{$i}}</option>
                                                    @endfor
                                                    @for($i=1; $i<=5; $i++)
                                                    <option value="feature-{{$i}}">Feature News {{$i}}</option>
                                                    @endfor
                                                    @for($i=1; $i<=2; $i++)
                                                    <option value="city-{{$i}}">City News {{$i}}</option>
                                                    @endfor
                                                    @for($i=1; $i<=2; $i++)
                                                    <option value="rss-{{$i}}">Rss News {{$i}}</option>
                                                    @endfor
                                                    @for($i=1; $i<=1; $i++)
                                                    <option value="ads-{{$i}}">Ads {{$i}}</option>
                                                    @endfor
                                                    @for($i=1; $i<=1; $i++)
                                                    <option value="poll-{{$i}}">Poll {{$i}}</option>
                                                    @endfor
                                                    @for($i=1; $i<=5; $i++)
                                                    <option value="banner-{{$i}}">Banner {{$i}}</option>
                                                    @endfor
                                                    @for($i=1; $i<=5; $i++) 
                                                    <option value="breaking-news-{{$i}}">Breaking News {{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="required" for="name">Bacground Color</label>
                                                <input type="text" name="background_color" value="#fff" class="form-control gradient-colorpicker" >
                                            </div>
                                            <div class="form-group">
                                                <label for="background_color">Border Color</label>
                                                <input type="text" name="borders" id="borders" class="form-control gradient-colorpicker" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="required" for="name">Text Color</label>
                                                <input name="text_color" value="#666" class="gradient-colorpicker form-control" >
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="required" for="bg_text">Box BG Color</label>
                                                <input type="text" name="bg_text" id="bg_text" value="#eee" class="form-control gradient-colorpicker" >
                                            </div>
                                            <div class="form-group">
                                                <label for="class_1">Class 1</label>
                                                <select required name="class_1" class="form-control">
                                                    @for($i=1; $i<=10; $i++)
                                                    <option value="mintitle_{{$i}}">Class {{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="required" for="bt_text">Box Color</label>
                                                <input name="bt_text" id="bt_text" value="#666" class="gradient-colorpicker form-control" >
                                            </div>
                                            <div class="form-group">
                                                <label for="class_2">Class 1</label>
                                                <select required name="class_2" class="form-control">
                                                    @for($i=1; $i<=10; $i++)
                                                    <option value="subtitle_{{$i}}">Class {{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>

                                       <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required">Padding</label>
                                                <input type="text" value="0" class="form-control" placeholder="Example: 7" name="padding">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required">Margin</label>
                                                <input type="text" value="0" class="form-control" placeholder="Example: 7" name="margin">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="required">Number Of Item</label>
                                                <input type="number" value="7" class="form-control" placeholder="Example: 7" name="item_number">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group"> 
                                                <label class="dropify_image">Title Image</label>
                                                <input type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="title_img" id="input-file-events">
                                                <i class="info">Recommended size: any</i>
                                            </div>
                                            @if($errors->has('title_img'))
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $errors->first('title_img') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <label class="codex">Ads code</label>
                                            <textarea name="codex" class="form-control" placeholder="Enter details" id="codex" rows="9"></textarea>
                                        </div>
                                        
                                        <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="colmd">Desktop</label>
                                                    <select required name="colmd" class="form-control">
                                                        @for($i=1; $i<=12; $i++)
                                                        <option value="col-md-{{$i}}">col-md-{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="colxs">Grid</label>
                                                    <select required name="colxs" class="form-control">
                                                        @for($i=1; $i<=12; $i++)
                                                        <option value="{{$i}}">Grid {{$i}}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="device">Cat / Time</label>
                                                    <select name="device" class="form-control">
                                                        <option value="">Off</option>
                                                        <option value="1">On</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="lazyload">Lazyload</label>
                                                    <select required name="lazyload" class="form-control">
                                                        <option value="1">On</option>
                                                        <option value="">Off</option>
                                                    </select>
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
