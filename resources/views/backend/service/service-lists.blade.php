@extends('backend.layouts.master')
@section('title', 'Service list')

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
                        <h4 class="text-themecolor">Services List</h4>
                    </div>
                    <div class="col-md-7 align-self-center text-right">
                        <div class="d-flex justify-content-end align-items-center">

                            <a href="{{route('service.create')}}" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New Service</a>
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
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Services Name</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($services as $data)
                                            <tr id="item{{$data->id}}">
                                                <td>{{$data->title}}</td>
                                                <td>@if($data->ServiceType){{$data->ServiceType->title}}@endif</td>
                                                
                                                <td>
                                                    <div class="custom-control custom-switch">
                                                      <input name="status"  onclick="satusActiveDeactive('services', {{$data->id}})" type="checkbox" class="custom-control-input" {{($data->status == 1) ? 'checked' : ''}} id="{{$data->id}}">
                                                      <label class="custom-control-label" for="{{$data->id}}"></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="{{route('service_details', $data->slug)}}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> View</a>

                                                    <a href="{{route('admin.pageSection', $data->slug)}}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Manage Page</a>

                                                    <a href="{{ route('service.edit', $data->slug) }}" class="btn btn-info btn-sm"><i class="ti-pencil" aria-hidden="true"></i> Edit</a>
                                                     @if($data->is_default !=1)
                                                    <button data-target="#delete" onclick="deleteConfirmPopup('{{ route("service.delete", $data->id )}}')" class="btn btn-danger btn-sm" data-toggle="modal"><i class="ti-trash" aria-hidden="true"></i> Delete</button>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                            <tr><td colspan="6">{{$services->links()}}</td></tr>
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
        @include('backend.modal.delete-modal')

@endsection

