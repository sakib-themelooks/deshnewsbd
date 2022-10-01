@php
$verification_media = DB::table('general_settings')->select('verification_media')->first()->verification_media;
@endphp
@extends('backend.layouts.master')
@section('title', 'Site Setting')

@section('css')
<link href="{{asset('backend/assets')}}/node_modules/bootstrap-switch/bootstrap-switch.min.css" rel="stylesheet">
<link href="{{asset('backend/css')}}/pages/bootstrap-switch.css" rel="stylesheet">
<style type="text/css">
    .text-muted {
        margin: 5px 0 0
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
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Site</a></li>
                        <li class="breadcrumb-item active">Setting</li>
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Site Setting</h4>
                        <i class="drag-drop-info">Drag & drop sorting position</i>
                        <table class="table">
                            <tbody class="" id="positionSorting" data-table="site_settings">
                                @foreach($siteSettings as $siteSetting)
                                <tr id="item{{$siteSetting->id}}">
                                    <td style="padding-left: 30px;">
                                        <h4>{{ str_replace('_', ' ', ucwords($siteSetting->type)) }}</h4>

                                        <p class="text-muted font-13"></p>
                                        <div class="bt-switch">
                                            <input onchange="siteSettingActiveDeactive(this, '{{$siteSetting->type}}')"
                                                {{ ($siteSetting->status == 1) ? 'checked' : ''}} type="checkbox"
                                            data-on-color="success" data-off-color="danger" data-on-text="Enabled"
                                            data-off-text="Disabled">
                                        </div>
                                        @if($siteSetting->message)
                                        <p class="text-muted font-13">{!! $siteSetting->message !!}</p>
                                        @endif

                                        <form id="{{$siteSetting->type}}"
                                            style="display: {{($siteSetting->status == 1) ? 'block' : 'none'}};">
                                            <input type="hidden" name="type" value="{{$siteSetting->type}}">
                                            @if($siteSetting->type == 'customer_account_activation')
                                            <p class="text-muted font-13">Select account verification via SMS/Email.
                                            </p>
                                            <label for="email{{$siteSetting->id}}"> <input type="radio" name="value"
                                                    value="email"
                                                    onclick="siteSettingValueUpdate('{{$siteSetting->type}}')" {{
                                                    ($siteSetting->value == 'email') ? 'checked' : '' }}
                                                id="email{{$siteSetting->id}}">
                                                Email</label>
                                            <label for="sms{{$siteSetting->id}}"> <input type="radio" name="value"
                                                    value="sms"
                                                    onclick="siteSettingValueUpdate('{{$siteSetting->type}}')" {{
                                                    ($siteSetting->value == 'sms') ? 'checked' : '' }}
                                                id="sms{{$siteSetting->id}}">
                                                SMS</label>

                                            @endif

                                            @if($siteSetting->type == 'vendor_account_activation')
                                            <p class="text-muted font-13">Select account verification via SMS/Email.</p>
                                            <label for="email{{$siteSetting->id}}"> <input type="radio" name="value"
                                                    value="email"
                                                    onclick="siteSettingValueUpdate('{{$siteSetting->type}}')" {{
                                                    ($siteSetting->value == 'email') ? 'checked' : '' }}
                                                id="email{{$siteSetting->id}}">
                                                Email</label>
                                            <label for="sms{{$siteSetting->id}}"> <input type="radio" name="value"
                                                    value="sms"
                                                    onclick="siteSettingValueUpdate('{{$siteSetting->type}}')" {{
                                                    ($siteSetting->value == 'sms') ? 'checked' : '' }}
                                                id="sms{{$siteSetting->id}}">
                                                SMS</label>
                                            @endif

                                            @if($siteSetting->type == 'facebook_login' || $siteSetting->type ==
                                            'google_login' || $siteSetting->type == 'twitter_login' ||
                                            $siteSetting->type == 'adblock')
                                            <p class="text-muted font-13">You need to configure {{str_replace('_', ' ',
                                                $siteSetting->type)}} Client correctly to enable this feature. </p>
                                            <a target="_blank" href="{{ route('socialLoginSetting') }}">Configure
                                                Now</a>
                                            @endif

                                            @if($siteSetting->type == 'google_recaptcha')
                                            <p class="text-muted font-13">You need to configure {{str_replace('_', ' ',
                                                $siteSetting->type)}} correctly to enable this feature. </p>
                                            <a target="_blank" href="{{ route('google_recaptcha') }}">reCaptcha
                                                Configure Now</a>
                                            @endif

                                            @if($siteSetting->type == 'vendor_commission')
                                            <p class="text-muted font-13">You need to configure {{str_replace('_', ' ',
                                                $siteSetting->type)}} correctly to enable this feature. </p>
                                            <a target="_blank" href="{{ route('vendor.commission') }}">Set Vendor
                                                commission</a>
                                            @endif

                                            @if($siteSetting->type == 'refund_request')
                                            <p class="text-muted font-13">You need to configure {{str_replace('_', ' ',
                                                $siteSetting->type)}} correctly to enable this feature. </p>
                                            <a target="_blank" href="{{ route('admin.refundConfig') }}">Set refund
                                                request </a>
                                            @endif

                                            @if($siteSetting->type == 'otp_configurations')

                                            <p class="text-muted font-13">You need to {{str_replace('_', ' ',
                                                $siteSetting->type)}} correctly to enable this feature. </p>
                                            <a target="_blank" href="{{ route('otp_configurations') }}">OTP
                                                configurations now</a>
                                            @endif

                                            @if($siteSetting->type == 'smtp_configurations')
                                            <p class="text-muted font-13">You need to {{str_replace('_', ' ',
                                                $siteSetting->type)}} correctly to enable this feature. </p>
                                            <a target="_blank" href="{{ route('smtp_settings') }}">smtp configurations
                                                now</a>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td style="padding-left: 30px;">
                                        <h4 class="text-muted font-18 ">Select Verification Type</h4>
                                        <select class="form-control" name="verification_media" id="verification_media"
                                            onchange="updateVerificationMedia()">
                                            <option value="both" {{$verification_media=='both' ?'selected':''}}>Either
                                                SMS Or
                                                Email
                                            </option>
                                            <option value="email" {{$verification_media=='email' ?'selected':''}}>Email
                                                based
                                                verification</option>
                                            <option value="sms" {{$verification_media=='sms' ?'selected':''}}>SMS based
                                                verification</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->

@endsection

@section('js')
<script src="{{asset('backend/assets')}}/node_modules/jqueryui/jquery-ui.min.js"></script>
<script type="text/javascript">
    //change status by field type
        function siteSettingActiveDeactive(el, field){
        	if($(el).is(':checked')){
              $('#'+field).show();
            }
            else{
                $('#'+field).hide();
            }
            // var  url = '{{route("siteSettingActiveDeactive")}}';
            // $.ajax({
            //     url:url,
            //     method:"get",
            //     data:{field:field},
            //     success:function(data){
            //         if(data.status){
            //             toastr.success(data.message);
            //         }else{
            //             toastr.error(data.message);
            //         }
            //     }
            // });




            $.post("{{ route('siteSettingActiveDeactive') }}", {
                _token: '{{ csrf_token() }}',
                field: field
            },
            function(data, status) {
                if(data.status){
                    toastr.success(data.message);
                }else{
                    toastr.error(data.message);
                }
            }).fail(function(xhr, status, error) {
                toastr.error("Unable to perform request");
            });
        }

        //set value 
        function siteSettingValueUpdate(type){
            $.ajax({
                url:'{{route("siteSettingUpdate")}}',
                type:'get',

                data:$('#'+type).serialize(),
                success:function(data){
                    if(data.status == 'success'){
                        toastr.success(data.msg);
                    }else{
                        toastr.error('Update failed.');
                    }
                 }
            });
        }

        function updateVerificationMedia() {
            $.post("{{route('update.verification.media')}}",{
                _token:'{{csrf_token()}}',
                verification_media: $('#verification_media').val()
            },
            function (details, status) {
                if(details.status == 'success'){
                    toastr.success('verification media updated');
                }else{
                    toastr.error('Update failed.');
                }
            }).fail(function (xhr, status, error) {
                toastr.error("Update failed.");
            });
        }
</script>
<!-- bt-switch -->
<script src="{{asset('backend/assets')}}/node_modules/bootstrap-switch/bootstrap-switch.min.js"></script>
<script type="text/javascript">
    $(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
    var radioswitch = function() {
        var bt = function() {
            $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioState")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
            }), $(".radio-switch").on("switch-change", function() {
                $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
            })
        };
        return {
            init: function() {
                bt()
            }
        }
    }();
    $(document).ready(function() {
        radioswitch.init()
    });
</script>
@endsection