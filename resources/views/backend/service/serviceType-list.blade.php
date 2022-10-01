@extends('backend.layouts.master')
@section('title', 'Service Type list')
@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{asset('backend/assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('backend/assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <link href="{{asset('backend/assets')}}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        
        .bootstrap-tagsinput{
            width: 100% !important;
            padding: 5px;
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
                    <h4 class="text-themecolor">Service Type List</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Service Type</a></li>
                            <li class="breadcrumb-item active">list</li>
                        </ol>
                        <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create Service Type</button>
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

                    <div class="card ">
                        <div class="card-body">
                            <i class="drag-drop-info">Drag & drop sorting position</i>
                            <div class="table-responsive">
                               
                                <table id="config-table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#SL</th>
                                            <th>Type Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="positionSorting" data-table="categories">
                                        <?php $i=1;?>
                                        @foreach($serviceTypes as $serviceType)
                                        <tr id="item{{$serviceType->id}}">
                                            <td>{{$i++}}</td>
                                            <td>{{$serviceType->title}}</td>
                                            <td>{{($serviceType->status == 1)? 'Active' : 'Deactive'}}</td>
                                            <td>
                                                 <a href="{{route('admin.pageSection', $serviceType->slug)}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Manage Section</a>
                                                <button type="button" onclick="edit('{{$serviceType->id}}')"  data-toggle="modal" data-target="#edit" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</button>
                                                <button type="button" onclick="deleteConfirmPopup('{{ route("serviceType.delete", $serviceType->id)  }}')" class="btn btn-danger btn-sm"> <i class="ti-trash" aria-hidden="true"></i> Delete</button></td>
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
    <!-- add Modal -->
    <div class="modal fade" id="add" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Service Type</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body form-row">
                    <div class="card-body">
                        <form action="{{route('serviceType.store')}}" enctype="multipart/form-data" method="POST">
                            {{csrf_field()}}
                            <div class="form-body">
                                <!--/row-->
                                <div class="row justify-content-md-center">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="bangla">Service Name</label>
                                            <input  name="title" id="bangla" value="{{old('title')}}" required="" type="text" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="head-label">
                                            <label class="switch-box">Status</label>
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
    
    <!-- update Modal -->
    <div class="modal fade" id="edit" role="dialog"  tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <form action="{{route('serviceType.update')}}" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Service Type</h4>
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

    <!-- delete Modal -->
    @include('backend.modal.delete-modal')

    
@endsection
@section('js')
    <script src="{{asset('backend/assets')}}/node_modules/jqueryui/jquery-ui.min.js"></script>
    <!-- This is data table -->
    <script src="{{asset('backend/assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

   <script>
       // responsive table
        $('#config-table').DataTable({
            responsive: true,
            ordering: false
        });
    </script>
    <script type="text/javascript">

    function edit(id){
        var  url = '{{route("serviceType.edit", ":id")}}';
        url = url.replace(':id',id);
        $.ajax({
        url:url,
        method:"get",
        success:function(data){
            if(data){
                $("#edit_form").html(data);
                $('.tagsinput').tagsinput();
            }
        }

        });
    }
</script>
@endsection
