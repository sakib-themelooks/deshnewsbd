@php
use App\Models\Permission;
$permissions = Permission::all();
@endphp
@extends('backend.layouts.master')
@section('title', 'Profile Update')
@section('css')
<link href="{{asset('backend/assets')}}/node_modules/dropify/dist/css/dropify.min.css" rel="stylesheet"
    type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
    .dropify-wrapper {
        height: 130px !important;
    }
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

            <div class="col-md-12 align-self-center ">
                <div class="d-fl ">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
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
                <form action="{{route('admin.user.update')}}" enctype="multipart/form-data" method="POST"
                    class="floating-labels">
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <div class="form-body">
                        <!--/row-->
                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input name="name" id="name" value="{{$user->name}}" required="" type="text"
                                        class="form-control">
                                </div>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('name') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="user_name">User Name</label>
                                    <input id="user_name" type="text" value="{{$user->username}}" class="form-control"
                                        name="user_name" required>
                                </div>
                                @if ($errors->has('user_name'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('user_name') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input id="email" type="email" value="{{$user->email}}" class="form-control"
                                        name="email" required autocomplete="email">
                                </div>
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('email') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phone">Mobile number</label>
                                    <input id="phone" type="number" value="{{$user->mobile}}" class="form-control"
                                        name="phone" required>
                                </div>
                                @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('phone') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h6 for="permissions">Select Permission</h6>
                                    <select class="form-control" id="permissions" name="permissions[]"
                                        multiple="multiple">
                                        @foreach($permissions as $permission)
                                        <option value="{{$permission->id}}" {{in_array($permission->
                                            id,$user->permissions)?'selected':''}}>{{$permission->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="dropify_image">Feature Image</label>
                                    <input type="file" class="dropify" accept="image/*" data-type='image'
                                        data-allowed-file-extensions="jpg jpeg png gif" data-max-file-size="2M"
                                        name="phato" id="input-file-events">
                                </div>
                                @if ($errors->has('phato'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('phato') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input id="password" type="password" class="form-control" name="password">
                                </div>
                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    {{ $errors->first('password') }}
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input id="password_confirmation" type="password" class="form-control"
                                        name="password_confirmation">
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label style="background: #fff;top:-10px;z-index: 1" for="notes">Details</label>
                                    <textarea name="notes" class="form-control" placeholder="Enter details" id="notes"
                                        rows="2">{{old('notes')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <div class="head-label">
                                    <label class="switch-box">Status</label>
                                    <div class="status-btn">
                                        <div class="custom-control custom-switch">
                                            <input name="status" type="checkbox" class="custom-control-input" {{
                                                ($user->status=='active' ) ? 'checked' : '' }} id="status">
                                            <label class="custom-control-label" for="status">Publish/UnPublish</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="submit" value="add" class="btn btn-success"> <i
                                            class="fa fa-check"></i>
                                        Update</button>
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
<!-- ============================================================== -->
<!-- End Page wrapper  -->

@endsection

@section('js')
<script src="{{asset('backend/assets')}}/node_modules/dropify/dist/js/dropify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
        $('#permissions').select2();
    });
</script>
@endsection