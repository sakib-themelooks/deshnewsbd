@extends('frontend.layouts.master')
@section('title', $user_details->name .' | Dashboard')

@section('MetaTag')
    <meta name="title" content="{{$user_details->name .' | '. Config::get('siteSetting.title')}}">
    <meta name="description" content="{{Config::get('siteSetting.description')}}">
    <meta name="keywords" content="{{Config::get('siteSetting.meta_keywords')}}" />
    <meta name="robots" content="index,follow" />
 
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta property="og:title" content="{{$user_details->name .' | '. Config::get('siteSetting.title')}}">
    <meta property="og:description" content="{{Config::get('siteSetting.description')}}">
    <meta property="og:image" content="{{asset('upload/images/users/'. $user_details->photo)}}">
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:site_name" content="{{Config::get('siteSetting.site_name')}}">
    <meta property="og:locale" content="bd">
    <meta property="og:type" content="article">

    <!-- Schema.org for Google -->

    <meta itemprop="title" content="{{$user_details->name .' | '. Config::get('siteSetting.title')}}">
    <meta itemprop="description" content="{{Config::get('siteSetting.description')}}">
    <meta itemprop="image" content="{{asset('upload/images/users/'. $user_details->photo)}}">

    <!-- Twitter -->
    <meta name="twitter:card" content="{{$user_details->name .' | '. Config::get('siteSetting.title')}}">
    <meta name="twitter:title" content="{{$user_details->name .' | '. Config::get('siteSetting.title')}}">
    <meta name="twitter:description" content="{{Config::get('siteSetting.description')}}">
    <meta name="twitter:site" content="{{url('/')}}">
    <meta name="twitter:creator" content="@Neyamul">
    <meta name="twitter:image:src" content="{{asset('upload/images/logo/'.Config::get('siteSetting.meta_image'))}}">
    <meta name="twitter:player" content="#">
    <!-- Twitter - -->
@endsection

@section('css')

<style type="text/css">

.sidebar a:hover {
  color: red;
}

.floating-labels .form-control{
	padding: 5px 10px;
}
.floating-labels label{
	background: #fff;
}

@media (max-width: 991px){

.sidebar.small-sidebar {
    display: block;
}

@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}
</style>
@endsection
@section('content')
<?PHP
$get_ads = App\Models\Addvertisement::where('page', 'user_profile')->where('status', 1)->get();
$top_head_right = $topOfNews = $middleOfNews = $bottomOfNews = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
foreach ($get_ads as $ads){
       if($ads->position == 2){
            $top_head_right = $ads->add_code;
        }elseif($ads->position == 3){
            $topOfNews = $ads->add_code;
        }elseif($ads->position == 4){
            $middleOfNews = $ads->add_code;
        }elseif($ads->position == 5){
            $bottomOfNews = $ads->add_code;
        }elseif($ads->position == 6){
            $sitebarTop = $ads->add_code;
        }elseif($ads->position == 7){
            $sitebarMiddle = $ads->add_code;
        }elseif($ads->position == 8){
            $sitebarBottom = $ads->add_code;
        }else{
            echo '';
        }
}
function banglaDate($date){
	return Carbon\Carbon::parse($date)->format('d F, Y');
}
?>

	<section class="block-wrapper">
		<div class="container section-body" >
			<div class="row">
				<div class="col-sm-3">
					@include('frontend.users.sidebar')
				</div>
				<div class="col-sm-6">
					
					<div class="">
						<div class="col-sm-12">
							<h3>Profile Information</h3>
							<table class="table">
							    <tbody>
							      	<tr> <td>Name:- {{ $user_details->name }}</td> </tr>
							        <tr><td>Email:- {{ $user_details->email }}</td>  </tr>
							        <tr><td>Mobile:- {{ $user_details->phone }}</td></tr>
							        <tr><td>Gender:-  @if($user_details->gender ==1 ) Male @elseif($user_details->gender == 2) Female @else Others @endif</td></tr>
							        <tr><td>Birthday:- {{ banglaDate($user_details->birthday) }} </td></tr>
							    </tbody>
							</table>
						</div>
					</div>

					<div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="advertisement">
                                <div class="desktop-advert">
                                    {!! $bottomOfNews !!}
                                </div>
                            </div>
                        </div>
                    </div>
				

					<div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="advertisement">
                                <div class="desktop-advert">
                                    {!! $bottomOfNews !!}
                                </div>
                            </div>
                        </div>
                    </div>
				</div>

				<div class="col-sm-3 div_border">
					<div class="sidebar large-sidebar">
	                    <div class="widget features-slide-widget">
	                        <div class="advertisement">
	                            <div class="desktop-advert">
	                                {!! $sitebarTop !!}
	                            </div>
	                            <div class="tablet-advert">
	                                {!! $sitebarTop !!}
	                            </div>
	                            <div class="mobile-advert">
	                                {!! $sitebarTop !!}
	                            </div>
	                        </div>
	                    </div>
						<!-- sidebar -->
						 @include('frontend.layouts.sitebar')

						<div class="widget features-slide-widget">
	                        <div class="advertisement">
	                            <div class="desktop-advert">
	                                {!! $sitebarBottom !!}
	                            </div>
	                            <div class="tablet-advert">
	                                {!! $sitebarBottom !!}
	                            </div>
	                            <div class="mobile-advert">
	                                {!! $sitebarBottom !!}
	                            </div>
	                        </div>
	                    </div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
