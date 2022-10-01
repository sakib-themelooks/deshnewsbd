@extends('backend.layouts.master')
@section('title', 'Category list')
@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{asset('backend/assets')}}/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css"
        href="{{asset('backend/assets')}}/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css">
    <link href="{{asset('backend/assets')}}/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        strong{font-weight: 600;}
        table p{line-height: normal; margin: 03px;}
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
                    <h4 class="text-themecolor">Category List</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Category</a></li>
                            <li class="breadcrumb-item active">list</li>
                        </ol>
                        <button data-toggle="modal" data-target="#add" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>
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
                            
                            <div class="table-responsive">
                               
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#SL</th>
                                            <th>Service</th>
                                            <th style="width:250px">Details</th>
                                            
                                            <th>Services</th>
                                            <th  style="width:220px">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;?>
                                        @foreach($serviceQueries as $serviceQuery)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>
                                                <a href="{{route('service_details', $serviceQuery->get_service->slug)}}"> 
                                                {{$serviceQuery->get_service->title}}</a>
                                            </td>
                                            <td>
                                                <a href="{{asset('upload/images/service/'.$serviceQuery->image)}}">
                                                <img width="120" src="{{asset('upload/images/service/'.$serviceQuery->image)}}" alt=""></a>
                                                <div>
                                                <p><strong>Name: </strong>{{$serviceQuery->name}}</p>
                                                @if($serviceQuery->mobile)<p><strong>Mobile: </strong>{{$serviceQuery->mobile}}</p>@endif
                                                @if($serviceQuery->email)<p><strong>Email: </strong>{{$serviceQuery->email}}</p>@endif
                                                @if($serviceQuery->quantity)<p><strong>Quantity: </strong>{{$serviceQuery->quantity}}</p>@endif</div>
                                            </td>
                                           
                                            <td>

                                                @if($serviceQuery->services)<br>
                                                    @foreach(json_decode($serviceQuery->services) as $key=>$values)
                                                    <p><strong> {{$key}}: </strong>
                                                        @if(is_array($values))  
                                                        @foreach($values as $value)
                                                        {{$value}},
                                                        @endforeach
                                                        @endif</a>
                                                    @endforeach
                                                @endif
                                            </td>
                                             <td>{{$serviceQuery->description}}</td>
                                        </tr>
                                        @endforeach
                                        <tr><td colspan="8">{{$serviceQueries->links()}}</td></tr>
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
 

    <!-- delete Modal -->
    @include('backend.modal.delete-modal')

@endsection

