@extends('backend.layouts.master')
@section('title', 'Social media links')

@section('css-top')
    <link href="{{asset('backend/assets')}}/node_modules/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">

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
                    <h4 class="text-themecolor">Social List</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Social</a></li>
                            <li class="breadcrumb-item active">list</li>
                        </ol>
                        <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i  class="fa fa-plus-circle"></i> Add New</button>
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
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Icon</th>
                                            <th>Link</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead> 
                                    <tbody id="positionSorting" data-table="socials">
                                        @if(count($socials)>0)
                                        @foreach($socials as $data)
                                        <tr id="item{{$data->id}}" >
                                           
                                            <td><a href="{{ url($data->link) }}"> {{$data->social_name}} </a></td>
                                            <td><i style="background: {{$data->background}}; padding:5px; color:{{$data->text_color}}" class="fa {{$data->icon}}"></i></td>
                                            <td> {{$data->link}}</td>
                                            <td>
                                                <div class="custom-control custom-switch" style="padding-left: 3.25rem;">
                                                  <input name="status" onclick="satusActiveDeactive('socials', {{$data->id}})"  type="checkbox" {{($data->status == 1) ? 'checked' : ''}} class="custom-control-input" id="status{{$data->id}}">
                                                  <label class="custom-control-label" for="status{{$data->id}}"></label>
                                                </div>
                                            </td>
                                            <td>
                                              
                                                <button title="Delete" data-target="#delete" onclick="deleteConfirmPopup('{{route("socialSettingDelete", $data->id)}}')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr><td colspan="7">Social media not found.</td></tr>
                                        @endif
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
    <div class="modal fade" id="add" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Social Link</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body form-row">
                    <div class="card-body">
                        <form action="{{route('socialSettingStore')}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-body">

                                <div class="form-group row">
                                    <label class="col-md-2 text-right col-form-label required" for="social_name">Site Name</label>
                                    <div class="col-md-8">
                                        <select name="social_name" required="" class="form-control">
                                            <option value="Facebook*fa-facebook">Facebook</option>
                                            <option value="Twitter*fa-twitter">Twitter  </option>
                                            <option value="Instagram*fa-instagram">Instagram </option>
                                            <option value="YouTube*fa-youtube">YouTube </option>
                                            <option value="Google plus*fa-google-plus-g">Google plus </option>
                                            <option value="WhatsApp*fa-whatsapp">WhatsApp</option>
                                            <option value="LinkedIn*fa-linkedin">LinkedIn  </option>
                                            <option value="Pinterest*fa-pinterest">Pinterest   </option>
                                            <option value="Viber*fa-viber">Viber</option>
                                            <option value="Reddit*fa-reddit">Reddit </option>
                                            <option value="Tumblr*fa-tumblr">Tumblr </option>
                                            <option value="Rss*fa-rss">Rss </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 text-right col-form-label required" for="link">Link</label>
                                    <div class="col-md-8">
                                        <input  name="link"  id="link" value="{{old('link')}}" required="" type="text" class="form-control">
                                    </div>
                                </div>
                             

                                <div class="form-group row">
                                    <label class="col-md-2 text-right col-form-label" for="name">Bacground Color</label>
                                    <div class="col-md-3">
                                        <input name="background_color" value="#ffffff" class="form-control">
                                    </div>
                               
                                    <label class="col-md-2 text-right col-form-label" for="name">Text Color</label>
                                    <div class="col-md-3">
                                        <input name="text_color" value="#000000" class="form-control">
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <label class="col-md-2 text-right col-form-label switch-box" style="margin-left: -12px; top:-12px;">Status</label>
                                     <div class="col-md-8">
                                        <div  class="status-btn" >
                                            <div class="custom-control custom-switch">
                                                <input name="status" checked  type="checkbox" class="custom-control-input" {{ (old('status') == 'on') ? 'checked' : '' }} id="status">
                                                <label  class="custom-control-label" for="status">Publish/UnPublish</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="submit" value="add" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                    <button type="button" data-dismiss="modal" class="btn btn-inverse">Cancel</button>
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
    <!-- This is data table -->
    <script src="{{asset('backend/assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
       <script>
        $(function () {
            $('#myTable').DataTable({"ordering": false});
        });

    </script>
@endsection
