@extends('backend.layouts.master')
@section('title', 'Reporter Request list')
@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{asset('backend/assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('backend/assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">

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
                        <h4 class="text-themecolor">Reporter Request List</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">
                            <a href="{{route('reporter.create')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</a>
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
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Resume</th>
                                                <th>Gender</th>
                                                <th>Accept</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i=1;?>
                                            @foreach($get_reporter as $show_reporter)
                                            @if($show_reporter->user)
                                            <tr id="item{{$show_reporter->id}}">
                                                 <td><img src="{{asset('upload/images/users/thumb_image/'. $show_reporter->user->image)}}" width="50" height="50"></td>
                                                
                                                <td>{{$show_reporter->user->name}}</td>
                                                <td>{{$show_reporter->user->phone}}</td>
                                                <td>{{$show_reporter->user->email}}</td>
                                                <td><a target="_blank" href="{{ asset('upload/attach/resume/'.$show_reporter->resume)}}"> Resume </a>
                                                </td>
                                                <td>@if($show_reporter->user->gender == 1) Male @elseif($show_reporter->user->gender == 2) Female @else Others @endif </td>
                                                <td>
                                                    <div class="custom-control custom-switch" style="padding-left: 3.25rem;">
                                                      <input name="status" onclick="statusAcceptReject('{{$show_reporter->user_id}}')"  type="checkbox" {{($show_reporter['status'] == 1) ? 'checked' : ''}} class="custom-control-input" id="{{$show_reporter->id}}">
                                                      <label class="custom-control-label" for="{{$show_reporter->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button data-target="#view" onclick="viewProfile('{{ $show_reporter->user_id }}')" class="btn btn-primary btn-sm" data-toggle="modal"><i class="ti-eye" aria-hidden="true"></i></button>

                                                    <a href="{{route('user_profile', $show_reporter->user->username)}}" class="btn btn-success btn-sm"><i class="fa fa-user" aria-hidden="true"></i> Profile </a>
                                                    <a href="{{ route('reporter.edit', $show_reporter->user_id)}}" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i></a>
                                                   
                                            </tr>
                                            @endif
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

        <!-- delete Modal -->
        <div id="delete" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icon-box">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h4 class="modal-title">Are you sure?</h4>
                        <p>Do you really want to delete these records? This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <button type="button" value="" id="itemID" onclick="deleteItem(this.value)" data-dismiss="modal" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('js')
    <!-- This is data table -->
    <script src="{{asset('backend/assets')}}/node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('backend/assets')}}/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js"></script>

    <!-- end - This is for export functionality only -->
    <script>
        $(function () {
            $('#myTable').DataTable();
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function (settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function (group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });

        });

    </script>

    <script type="text/javascript">

      function edit(id){
            var  url = '{{route("reporter.edit", ":id")}}';
            url = url.replace(':id',id);
            $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#edit_form").html(data);
                }
            }

        });

    }

    function statusAcceptReject(id){

        var  url = '{{route("reporterRequest.status", ":id")}}';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data.status == 'Accepted'){
                    toastr.success(data.message);
                }else{
                    toastr.error(data.message);
                }
            }
        });
    }

    function confirmPopup(id) {
        document.getElementById('itemID').value = id;
    }

    function deleteItem(id) {

            var link = '{{route("reporter.delete", ":id")}}';
            var link = link.replace(':id', id);
                $.ajax({
                url:link,
                method:"get",
                success:function(data){
                    if(data){
                        $("#item"+id).hide();
                        toastr.error(data);
                    }
                }

            });
        }

</script>
@endsection
