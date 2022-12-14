@extends('frontend.layouts.master')
@section('title', 'Our Family | '. Config::get('siteSetting.title'))
@section('MetaTag')
    <meta name="title" content="{{Config::get('siteSetting.title')}}">
    <meta name="description" content="{{Config::get('siteSetting.description')}}">
    <meta name="keywords" content="{{Config::get('siteSetting.meta_keywords')}}" />
    <meta name="robots" content="index,follow" />

    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta property="og:title" content="{{Config::get('siteSetting.title')}}">
    <meta property="og:description" content="{{Config::get('siteSetting.description')}}">
    <meta property="og:image" content="{{asset('upload/images/'.Config::get('siteSetting.meta_image'))}}">
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:site_name" content="{{Config::get('siteSetting.site_name')}}">
    <meta property="og:locale" content="en">
    <meta property="og:type" content="website">
    <meta property="og:type" content="article">

    <!-- Schema.org for Google -->

    <meta itemprop="title" content="{{Config::get('siteSetting.title')}}">
    <meta itemprop="description" content="{{Config::get('siteSetting.description')}}">
    <meta itemprop="image" content="{{asset('upload/images/'.Config::get('siteSetting.meta_image'))}}">

    <!-- Twitter -->
    <meta name="twitter:card" content="{{Config::get('siteSetting.title')}}">
    <meta name="twitter:title" content="{{Config::get('siteSetting.title')}}">
    <meta name="twitter:description" content="{{Config::get('siteSetting.description')}}">
    <meta name="twitter:site" content="{{url('/')}}">
    <meta name="twitter:creator" content="@Neyamul">
    <meta name="twitter:image:src" content="{{asset('upload/images/logo/'.Config::get('siteSetting.meta_image'))}}">
    <meta name="twitter:player" content="#">
    <!-- Twitter - -->
@endsection
@section('content')

<?PHP
$get_ads = App\Models\Addvertisement::where('page', 'reporter_page')->where('status', 1)->get();
$top_head_right = $topOfNews = $middleOfNews = $bottomOfNews = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
foreach ($get_ads as $ads){
    if($ads->position == 1){
        $top_head_right = $ads->add_code;
    }elseif($ads->position == 2){
        $bottomOfNews = $ads->add_code;
    }elseif($ads->position == 3){
        $sitebarTop = $ads->add_code;
    }elseif($ads->position ==4){
        $sitebarMiddle = $ads->add_code;
    }elseif($ads->position ==5){
        $sitebarBottom = $ads->add_code;
    }else{
        echo '';
    }
}
function banglaDate($date){

    $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'second', 'hours from now',  'days', 'weeks',  'ago', 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

    $bangDATE = array('???','???','???','???','???','???','???','???','???','???', '?????????????????????', '??????????????? ??????????????????', '?????????', '??????????????????',  '??????????????????', '???????????????????????????','?????????????????????????????????','???????????????','??????????????????','??????','?????????','???????????????','???????????????','??????????????????????????????','?????????????????????','?????????????????????','????????????????????????','??????????????????','??????????????????','??????????????????','????????????????????????',' ??????????????????','?????????????????????????????????','????????????????????????' );

    $formatBng = Carbon\Carbon::parse($date)->diffForHumans();
    $convertedDATE = str_replace($engDATE, $bangDATE, $formatBng);
    return $convertedDATE;
    }

    $get_title = App\models\Page::where('page_slug', 3)->first();
?>
		<section class="ticker-news category">
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="category-title">
							<span class="breaking-news" id="head-title">Our Family</span>
						</div>
					</div>
					<div class="col-sm-4">
                        {!! $top_head_right !!}
					</div>
				</div>
			</div>
		</section>
		<!-- block-wrapper-section
			================================================== -->
		<section class="block-wrapper">
			<div class="container section-body">
				<div class="row">
					<div class="col-sm-9" id="sticky-conent">
						<ul class="category-news">
	                        <li><i class="fa fa-home"></i><a href="#"> </a> / <a href="">Our Family</a></li>
	                    </ul>
						<div class="row">
							@foreach($get_reporters as $reporter)
							<div class="col-md-3" id="author-list">
								<div class="news-post image-post default-size">
									<img src="{{asset('upload/images/reporters/thumb_image/'. $reporter->userinfo->photo)}}" alt="">
									<div class="hover-box">
										<div class="inner-hover top-line">
											<h2><a href="{{route('user_details', $reporter->username)}}">{{$reporter->name .' '.$reporter->lname}}</a></h2>
											<ul class="post-tags">
												<li></li>
												<li style="font-size: 15px"><i class="fa fa-tags"></i>{{$reporter->userinfo->designation}}</li>
											</ul>
                                            <ul class="social-icons">
                                                <li>
                                                    <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                                                    <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                                                    <a class="rss" href="#"><i class="fa fa-rss"></i></a>
                                                    <a class="google" href="#"><i class="fa fa-google-plus"></i></a>
                                                    <a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                                                    <a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a>
                                                </li>
                                            </ul>
										</div>
									</div>
								</div>
							</div>
							@endforeach
                            <div class="pagination-box">
                                {{$get_reporters->links()}}
                            </div>
						</div>
						<!-- End block content -->
                        <div class="advertisement">
                            <div class="desktop-advert">
                                {!! $bottomOfNews !!}
                            </div>
                            <div class="tablet-advert">
                                {!! $bottomOfNews !!}
                            </div>
                            <div class="mobile-advert">
                                {!! $bottomOfNews !!}
                            </div>
                        </div>
					</div>

					<div class="col-sm-3" id="sticky-conent">
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
		<!-- End block-wrapper-section -->
@endsection
