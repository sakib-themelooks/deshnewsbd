@extends('reporter.layouts.master')
@section('title', 'Add posts')
@section('css')

    <link href="{{asset('backend/assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets')}}/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets')}}/node_modules/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />

    <link href="{{asset('backend/assets')}}/node_modules/summernote/dist/summernote-bs4.css" rel="stylesheet" type="text/css" />

    <link href="{{asset('backend')}}/css/gallery.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="{{asset('backend/assets')}}/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/assets')}}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
  
    <style>
.bootstrap-tagsinput,
.select2-container--default .select2-selection--single .select2-selection__rendered,
.form-control {
    border: 1px solid #000000;
}
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
        #image .dropify-wrapper, #video .dropify-wrapper {
            height: 18rem !important;
        }
        .news-type label{position: initial !important;cursor: pointer !important}

        .news-type input{display: none; }
        .news-type  .active{
            background: #fb9678;
            color: #fff;
            padding: 6px;
            border-radius: 3px;
        }

        .attach-file-box{
            position: relative;
            padding: 15px;
            border: 1px solid #e1e1e1;
            margin: 15px 0px;
        }
        .laodBtn{display: none;}
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
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">বাংলা খবর তৈরি করুন</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <a href="{{route('reporter.news.list')}}" class="btn btn-info btn-sm d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> News List</a>
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
                <div id="pageLoading"></div>
                <div class="card-body">
                    <form action="{{route('reporter.news.store')}}" enctype="multipart/form-data"  data-parsley-validate  method="post" id="news">
                        @csrf

                        <div class="form-body">
                            <div class="row" style="align-items: flex-start; overflow: visible;">
                                <div class="col-md-9 divrigth_border">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" for="news_title">সংবাদ শিরোনাম লিখুন</label>
                                                <input type="text" onchange="getSlug(this.value)" value="{{old('news_title')}}"  name="news_title" required="" placeholder="Enter news title here." id="news_title" class="form-control" >
                                            </div>
                                        </div>
                                       

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="required" style="background: #fff;top:-10px;z-index: 1" for="news_dsc">বিস্তারিত বাংলা লিখুন</label>
                                                <textarea name="news_dsc" required="" class="form-control" placeholder="Enter news description here." id="news_dsc" rows="5">{{old('news_dsc')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 news-type" style="display: none;">
                                            <div  style="margin-top: 20px; position:relative; padding: 15px; border: 1px solid #e1e1e1">
                                                <span class="dropify_image_area" style="top:-12px;">সংবাদের ধরন</span>
                                                <input type="radio" checked="checked" onclick="newsType( 'Standard')" value="1" name="type" id="Standard"><label for="Standard" class="active"><i class="fa fa-text-height" aria-hidden="true"></i> Standard</label>

                                                <input type="radio" onclick="newsType( 'Image')" value="2" name="type" id="Image"><label for="Image"><i class="fa fa-camera" aria-hidden="true"></i> Image</label>

                                                <input onclick="newsType( 'Video')" value="3" type="radio" name="type" id="Video"><label for="Video"><i class="fa fa-video" aria-hidden="true"></i> Video</label>

                                                <input type="radio" onclick="newsType( 'Audio')" value="4" name="type" id="Audio"><label for="Audio"><i class="fa fa-audio-description" aria-hidden="true"></i> Audio</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12 attach-file-area"></div>

                                        <div class="col-md-12">
                                            
                                            <div class="form-group">
                                                <span class="required" for="meta_title">মেটা টাইটেল</span>
                                                <input type="text" value="{{old('meta_title')}}"  name="meta_title" id="meta_title" placeholder = 'Enter meta title'class="form-control" >
                                            </div>
                                            <div class="form-group">
                                           
                                                <span>ট্যাগ লিখুন</span>

                                                 <div class="tags-default">
                                                    <input type="text" class="form-control" name="keywords[]"  data-role="tagsinput" placeholder="add keywords" />
                                                </div>
                                           
                                            </div>
                                            <div class="form-group">
                                                <span class="control-label" for="meta_description">মেটা বর্ণনা</span>
                                                <textarea class="form-control" name="meta_description" id="meta_description" rows="2" style="resize: vertical;" placeholder="Enter Meta Description">{{old('meta_description')}}</textarea>
                                            </div>

                                       
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 sticky-conent">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span class="required" for="category">Category</span>
                                                <select name="category[]" multiple required id="category" class="form-control selectpicker custom-select">
                                                    
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}" @if(old('category') && in_array($category->id, json_decode(old('category')))) selected @endif value="{{$category->id}}">{{$category->category_bd}}</option>
                                                            @foreach($category->subcategories as $subcategory)
                                                           <option @if(old('category') && in_array($subcategory->id, json_decode(old('category')))) selected @endif value="{{$subcategory->id}}">-{{$subcategory->category_bd}}</option>
                                                            @foreach($subcategory->subcategories as $childcategory)
                                                            <option @if(old('category') && in_array($childcategory->id, json_decode(old('category')))) selected @endif value="{{$childcategory->id}}">--{{$childcategory->category_bd}}</option>
                                                            @endforeach
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                          
                                            <span id="subcategory"></span>
                                            <span id="getdistrict"></span>
                                            <span id="getupzilla"></span>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <span for="location">Location</span>
                                                <select name="location[]" multiple id="location" class="selectpicker form-control custom-select">
                                                    
                                                    @foreach($divisions as $division)
                                                        <option value="{{$division->id}}" @if(old('location') && in_array($division->id, json_decode(old('location')))) selected @endif>{{$division->name_bd}}</option>
                                                            @foreach($division->subLocations as $zilla)
                                                           <option @if(old('location') && in_array($zilla->id, json_decode(old('location')))) selected @endif value="{{$zilla->id}}">-{{$zilla->name_bd}}</option>
                                                            @foreach($zilla->subLocations as $upzilla)
                                                            <option @if(old('location') && in_array($upzilla->id, json_decode(old('location')))) selected @endif value="{{$upzilla->id}}">--{{$upzilla->name_bd}}</option>
                                                            @endforeach
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="display: none;">
                                            <div class="form-group">
                                                <label class="required" for="lang">Language</label>
                                                <select required name="lang" id="lang" class="form-control custom-select">
                                                   <option value="bd">Bangla</option>
                                                   <option value="en">English</option>
                                                </select>
                                            </div>
                                        </div>
                                       
                                       
                                        <div class="col-md-12" style="margin-top: 1em;">
                                            <div class="form-group">
                                            <div class="head-label" data-toggle="modal" data-target="#image" data-whatever="@mdo">
                                                <span class="dropify_image_area">ছবি যুক্ত করুন</span>
                                                
                                                <div id="upload-image">
                                                    <div class="dropify-wrapper" style="border:none !important;height:80px">
                                                        <div class="dropify-message">
                                                            <span style="font-size: 1.5em" class="fa fa-plus-circle"></span>
                                                            <p>ছবি এড করুন</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span><input style="display: none;" id="image_path" value="{{old('photo')}}" name="image"></span>
                                            </div>
                                            </div>
                                        </div>
                                        @php $news_activation = App\Models\SiteSetting::where('type', 'news_activation')->first();  @endphp
                                        @if(in_array('news_status', explode(',', Auth::guard('reporter')->user()->permission)) || $news_activation->status != 1)
                                        <div class="col-md-12" >
                                            <div class="form-group">
                                            <div class="head-label">
                                                <label class="dropify_image_area">স্ট্যাটাস প্রকাশ করুন</label>
                                                <div  >
                                                    <div class="custom-control custom-switch">
                                                      <input name="status" {{ (old('status') == 'on') ? 'checked' : 'checked' }} type="checkbox" class="custom-control-input" id="status">
                                                      <label style="padding: 8px 15px;" class="custom-control-label" for="status">Publish/Unpublish</label>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div><hr>
                        <div class="form-actions pull-right" style="float: right;">
                            <button type="submit" id="uploadBtn" name="submit" value="save" class="btn btn-success"> <i class="fa fa-save"></i> সাবমিট করুন</button>
                            <button type="submit"  name="submit" value="draft" class="btn btn-info"> <i class="fa fa-archive"></i> ড্রাফ রাখুন</button>
                        </div>
                    </form>
                </div>
                
            </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->

    <div class="modal bs-example-modal-lg" id="image" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">

                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#image-tab" role="tab"><i class="fa fa-cloud-upload" aria-hidden="true"></i> <span class="hidden-xs-down">Upload File</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" onclick="imageGallery()" data-toggle="tab" href="#image-gallery" role="tab"><i class="fa fa-hdd-o" aria-hidden="true"></i> <span class="hidden-xs-down">Media Gallery</span></a> </li>
                       </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border">
                            <div class="tab-pane active" id="image-tab" role="tabpanel">
                                <form action="{{route('photo.upload')}}" id="imageUploadForm" method="post" class="floating-labels" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="upload-bar">
                                            <p id="message-image"></p>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-image" role="progressbar" aria-valuenow=""
                                                     aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                                    0%
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="upload-file">
                                            <input type="file" class="dropify" onchange="uploadselectImage()" required="required" accept="image/*" data-type='image'  data-max-file-size="5M"  name="photo[]" id="input-file-events">
                                            <i class="info">Max upload image size 5MB</i>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" id="dismis" class="btn btn-info" data-dismiss="modal">Insert image</button>

                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane  p-20" id="image-gallery" role="tabpanel">
                               <form action="{{route('selectImage')}}" method="get" id="selectImage">
                                    <div class="row">
                                        <div class="col-md-9 col-sm-8 col-9 inner-scroll">
                                            <div class="row" id="showGalleryImage"></div>
                                            <div class="ajax-load text-center" id="data-loader"><img src="{{ asset('backend/assets/images/loader.gif')}}"></div>
                                            <div class="col-md-12 laodBtn text-center" ><button type="button" onclick ="imageGallery()" class="btn btn-success">Load More</button></div>
                                        </div>
                                        <div class="col-md-3 col-sm-4 col-3">
                                            <div id="show_image_details"></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-info">Insert image</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    <!-- video upload modal -->
    <div class="modal bs-example-modal-lg" id="video" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="border-bottom: 0px !important;">
                    <h4 class="modal-title" id="exampleModalLabel1">Upload Gallery Image</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#video-tab" role="tab"><i class="fa fa-cloud-upload" aria-hidden="true"></i> <span class="hidden-xs-down">Upload File</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" onclick="videoGallery()" data-toggle="tab" href="#video-gallery" role="tab"><i class="fa fa-hdd-o" aria-hidden="true"></i> <span class="hidden-xs-down">Media Gallery</span></a> </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content tabcontent-border">
                        <div class="tab-pane active" id="video-tab" role="tabpanel">
                            <form action="{{route('video.upload')}}" id="videoUploadForm" method="post" class="floating-labels" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="upload-bar">
                                        <p id="message-video"></p>
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-video" role="progressbar" aria-valuenow=""
                                                 aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                                0%
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="upload-file">
                                        <input type="file" class="dropify" onchange="uploadselectVideo()" accept="video/*" data-type='video' required="required" data-allowed-file-extensions="mpeg ogg mp4 webm 3gp mov flv avi wmv"   name="video" id="input-file-events">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="dismis-video" class="btn btn-info" data-dismiss="modal">Insert Video</button>

                                </div>
                            </form>
                        </div>
                        <div class="tab-pane  p-20"  id="video-gallery" role="tabpanel">

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{asset('backend/assets')}}/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="{{asset('backend/assets')}}/node_modules/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('backend/assets')}}/node_modules/multiselect/js/jquery.multi-select.js"></script>

   
    <!-- end - This is for export functionality only -->
    <script>   $('.selectpicker').selectpicker(); </script>

    <script src="{{asset('backend/assets')}}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>

    <script src="{{asset('backend/assets')}}/node_modules/summernote/dist/summernote-bs4.min.js"></script>
    <script src="//cdn.ckeditor.com/4.17.1/full/ckeditor.js"></script>
<script type="text/javascript"> 
CKEDITOR.replace( 'news_dsc');
//     CKEDITOR.replace( 'news_dsc', {
//         height: 500,
        
//         filebrowserBrowseUrl:'{{route("photoFileBrowse")}}',
//         filebrowserUploadUrl: "{{route('photo.photo_uploadCKEditor', ['_token' => csrf_token() ])}}",
//       // enterMode: CKEDITOR.ENTER_BR,
//         allowedContent: true,
//         contentsCss : '{{asset('backend/assets')}}/contents.css',
//         toolbarGroups: [
//                     		{ name: 'clipboard', groups: [ 'undo', 'clipboard' ] },
// 		{ name: 'document', groups: [ 'document', 'mode', 'doctools' ] },
// 		{ name: 'insert', groups: [ 'insert' ] },
// 		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
// 		{ name: 'forms', groups: [ 'forms' ] },
// 		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
// 		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
// 		{ name: 'links', groups: [ 'links' ] },
// 		{ name: 'styles', groups: [ 'styles' ] },
// 		{ name: 'colors', groups: [ 'colors' ] },
// 		{ name: 'tools', groups: [ 'tools' ] },
// 		{ name: 'others', groups: [ 'others' ] },
// 		{ name: 'about', groups: [ 'about' ] }
//                     	],
//         removeButtons: 'Save,NewPage,ExportPdf,Preview,Print,PasteFromWord,PasteText,Paste,Find,Replace,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Underline,Strike,Subscript,Superscript,CopyFormatting,RemoveFormat,Outdent,Indent,CreateDiv,JustifyLeft,JustifyCenter,JustifyRight,JustifyBlock,Language,BidiRtl,BidiLtr,Anchor,Smiley,SpecialChar,PageBreak,Iframe,HorizontalRule,Table,TextColor,BGColor,ShowBlocks,About,FontSize,Font,Templates',
//     });

</script>
    <script type="text/javascript">

        //check required fieled is filled or not
        $('#uploadBtn').on("click", function(){
            let valid = true;
            var fields = $("#news")
            .find("[required]")
            .serializeArray();

            $.each(fields, function (i, field) {
                if (!field.value){ valid = false; }
            });
            if (valid){  document.getElementById('pageLoading').style.display = 'block';  };
           
        });


        function getSlug(slug) {
            var  url = '{{route("news.slug", ":id")}}';
            url = url.replace(':id', slug);

            $.ajax({
                url:url,
                method:"get",
                data:{slug:slug, field:'news_slug',table:'news'},
                success:function(slug){
                    if(slug){
                        $('#news_slug').focus();
                        document.getElementById('news_slug').innerHTML = '<div style="display:flex" class="form-group"><input disabled="" required="" type="text" value="'+slug+'" id="slugEdit" name="news_slug" style="width:90%" class="form-control" ><span class="news_slug" style="border: 1px solid #ccc; padding: 5px; line-height: 25px;background: #efefef;cursor: pointer;" onclick="enable()">Edit</span></div>';
                    }else{
                        document.getElementById('news_slug').innerHTML = "";
                    }
                }
             });
        }

        function enable() {
           
            document.getElementById("slugEdit").disabled = false;
            $('#slugEdit').focus();
        }

        function get_subcategory(id=0){
            var  url = '{{route("get_subcategory", ":id")}}';
            url = url.replace(':id',id);

            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#subcategory").html(data);
                        $("#subcategory").focus();
                         $(".select2").select2();
                        document.getElementById('getdistrict').innerHTML = "";
                        document.getElementById('getupzilla').innerHTML = "";
                    }else{
                        document.getElementById('subcategory').innerHTML = "";
                        document.getElementById('getdistrict').innerHTML = "";
                        document.getElementById('getupzilla').innerHTML = "";
                    }
                }
            });
        }

        function get_district(id=0){
            var  url = '{{route("get_district", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#getdistrict").html(data);
                        $("#district").focus();
                         $(".select2").select2();
                        document.getElementById('getupzilla').innerHTML = "";
                    }else{
                        document.getElementById('getdistrict').innerHTML = "";
                        document.getElementById('getupzilla').innerHTML = "";
                    }
                }
            });
        }

        function get_upzilla(id=0){
            var  url = '{{route("get_upzilla", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#getupzilla").html(data);
                         $("#upzilla").focus();
                          $(".select2").select2();
                    }else{
                        $("#getupzilla").html('');
                    }
                }
            });
        }


    </script>
    <script type="text/javascript">
        $('.news-type label').click(function() {
            $(this).addClass('active').siblings().removeClass('active');
        });
        function newsType(name){
            if(name == 'Image'){
                $('.attach-file-area').html('<div class="attach-file-box"><span class="dropify_image_area">Add '+name+'</span><div class="row attach-file" ><div class="col-md-3" onclick="addField(\'image/*\')"><div class="dropify-wrapper" ><div class="dropify-message"><span style="font-size: 2em" class="fa fa-plus-circle"></span> <p>Add More '+name+'</p></div></div></div></div></div>');
            }else if(name == 'Video') {
                $('.attach-file-area').html('<div class="attach-file-box"><span class="dropify_image_area">Add '+name+'</span><div class="row attach-file" ><div class="col-md-3" onclick="addField(\'video/*\')"><div class="dropify-wrapper" ><div class="dropify-message"><span style="font-size: 2em" class="fa fa-plus-circle"></span> <p>Add More '+name+'</p></div></div></div></div></div>');

            }else if(name == 'Audio') {
                    $('.attach-file-area').html('<div class="attach-file-box"><span class="dropify_image_area">Add '+name+'</span><div class="row attach-file" ><div class="col-md-3" onclick="addField(\'audio/*\')"><div class="dropify-wrapper" ><div class="dropify-message"><span style="font-size: 2em" class="fa fa-plus-circle"></span> <p>Add More '+name+'</p></div></div></div></div></div>');

                }else{
                $('.attach-file-area').html('');
            }

        }

        var box = 1;

        function addField(accept){
            box++;
           $(".attach-file").prepend('<div class="col-md-3"><input type="file" multiple form="news" accept="'+accept+'"  name="attach_files[]" id="id_news_image'+box+'" /></div>');
            document.getElementById("id_news_image"+box).click();

            $("#id_news_image"+box).addClass('dropify');
            $('.dropify').dropify();
        }
    </script>

    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
    });
    </script>


    <script>
       
        // Enter form submit preventDefault for tags
        $(document).on('keyup keypress', 'form input[type="text"]', function(e) {
          if(e.keyCode == 13) {
            e.preventDefault();
            return false;
          }
        });
    </script>

    <script type="text/javascript" src="{{asset('backend/formjs/jquery.form.js')}}"></script>

    <script>
        function uploadselectImage(){
            $("#imageUploadForm").submit();
        }

        $(document).ready(function(){
            $('#imageUploadForm').ajaxForm({
                beforeSend:function(){
                    $('.loader-image').css('display', 'block');
                },
                uploadProgress:function(event, position, total, percentComplete)
                {
                    $('.progress-bar-image').text(percentComplete + '%');
                    $('.progress-bar-image').css('width', percentComplete + '%');
                },
                success:function(data)
                {
                    if(data.errors)
                    {
                        $('.progress-bar-image').text('0%');
                        $('.progress-bar-image').css('width', '0%');
                        $('#message-image').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
                    }
                    if(data.success)
                    {
                        $('.progress-bar-image').text('Upload completed');
                        $('.progress-bar-image').css('width', '100%');
                        $('#message-image').html('');
                        $('#upload-image').html(data.image);
                        $('#image_path').val(data.success);
                         $('#image_path').removeAttr('required');
                        $('#dismis').click();
                        // $('#media-gallery').click();
                        $('.dropify').dropify();
                        // Used events
                       
                    }
                }
            });

        });

        //load gallery image
        var page = 0;
        function imageGallery() {
            page++;
            loadMoreProducts(page);
        }
        //load more gallery image
        function loadMoreProducts(page){
           var  url = '{{route("imageGallery")}}';
            $.ajax({
                url: url+'?page=' + page,
                type: "get",
                beforeSend: function()
                {
                    $('.ajax-load').show();
                    $('.laodBtn').hide();
                }
            })
            .done(function(data)
            {
                $('.ajax-load').hide();
                $('.laodBtn').show();
                $("#showGalleryImage").append(data);
                
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                $('.ajax-load').hide();
            });
        }
      
        /// Select images

        $("#selectImage").submit(function(event){
            event.preventDefault();
             var  url = '{{route("selectImage")}}';
            $.ajax({
                url:url,
                type:'get',
                data:$(this).serialize(),
                success:function(data){
                    if(data){
                       
                       $('#upload-image').html(data.image);
                        $('#image_path').val(data.success);
                        $('#image_path').removeAttr('required');
                        $('#dismis').click();
                        // $('#media-gallery').click();
                        $('.dropify').dropify();
                       
                    }
                }
            });
        });

        /// image details

        function image_details(image, title){
           $('#show_image_details').html('<div class="head-label"><img class="image_info" src="<?php echo asset('upload/images/thumb_img') ?>/'+image+'"></div><label for="image_title">Image Title</label><textarea  name="image_title" id="image_title" class="form-control" >'+title+'</textarea>');
        }
    </script>


    <script>
        function uploadselectVideo(){
            $("#videoUploadForm").submit();
        }

        $(document).ready(function(){
            $('#videoUploadForm').ajaxForm({
                beforeSend:function(){
                    $('.loader-image').css('display', 'block');
                },
                uploadProgress:function(event, position, total, percentComplete)
                {
                    $('.progress-bar-video').text(percentComplete + '%');
                    $('.progress-bar-video').css('width', percentComplete + '%');
                },
                success:function(data)
                {
                    if(data.errors)
                    {
                        $('.progress-bar-video').text('0%');
                        $('.progress-bar-video').css('width', '0%');
                        $('#message-video').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
                    }
                    if(data.success)
                    {
                        $('.progress-bar-video').text('Upload completed');
                        $('.progress-bar-video').css('width', '100%');
                        $('#message-video').html('');
                        $('#upload-video').html(data.image);
                        $('#video_path').html(data.success);
                         $('#dismis-video').click();
                        // $('#media-gallery').click();
                    }
                }
            });

        });
    </script>

    <script>
        function videoGallery() {
            var  url = '{{route("videoGallery")}}';
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    if(data){
                        $("#video-gallery").html(data);
                    }
                }
            });

        }
    </script>

@endsection

