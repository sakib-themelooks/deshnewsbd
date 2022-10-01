@extends('frontend.layouts.master')
@section('title')
    @if($page){{$page->page_name_bd}} | @endif  {{Config::get('siteSetting.title')}}
@endsection
@section('Metatag')
@endsection
@section('content')
<?PHP
    $get_ads = App\Models\Addvertisement::where('page', 'custom_page')->where('status', 1)->get();
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
?>
<?PHP
function banglaDate($date){

    $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'second', 'hours from now',  'days', 'weeks',  'ago', 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

    $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০', 'সেকেন্ট', 'ঘন্টা পূর্বে', 'দিন', 'সপ্তাহ',  'পূর্বে', 'জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );

     $formatBng = Carbon\Carbon::parse($date)->format('j F, Y');
    $convertedDATE = str_replace( $engDATE, $bangDATE,  $formatBng);
    return $convertedDATE;
    }
?>

	<!-- block-wrapper-section
		================================================== -->
	<section class="block-wrapper">
		<div class="container section-body">
		    <span style="font-size:35px;padding:0 0.8em;color:#0066ff;">@if($page){{$page->page_name_bd}} @endif</span>
			<div class="row">
				<div class="col-md-9 col-xs-12 mix1" id="sticky-conent">
					
	                <div class="advertisement">
	                    <div class="desktop-advert">
	                       {!! $topOfNews !!}
	                    </div>
	           		</div>
	                @if(count($get_news)>0)
    	                @foreach($get_news as $news)
    	                @if($news->getCategory && $news->getCategory->cat_slug_en)
    						<a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}" class="col-md-6 col-xs-12 mmb">
                                <div class="col-md-4 col-xs-4 img_100 pps videos">
                                    @if($news->news_type)
                                    <i class="fa {{$news->news_type}}" aria-hidden="true"></i>
                                    @endif
                                    @if($news->thumb_url)
                                        <img src="{{$news->thumb_url}}"  alt="{{$news->title}}">
                                    @elseif(Config::get('siteSetting.lazyload'))
                                        @if($news->image)
                                        <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                                        @else
                                        <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                        @endif
                                    @elseif($news->image) 
                                    <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}" alt="{{($news->news_title)}}">
                                    @else
                                    <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                    @endif
                                </div>
                                <div class="col-md-8 col-xs-8 mix77y">
                                    <h1 class="box_text_color-1">{{$news->news_title}}</h1>
                                    <span><i class="fa fa-clock-o"></i>&nbsp; {{banglaDate($news->publish_date)}}</span>
                                </div>
                            </a>
                            @endif
                        @endforeach
                        
                        <div class="col-sm-12 pagination-box inline-block">
                            {{$get_news->links()}}
                        </div>
	                @else
	                <h2>News not found!.</h2>
	                @endif
	                <div class="row inline-block" id="sticky-conent">
	                    <div class="col-md-12 col-sm-12">
	                        <div class="advertisement">
	                            <div class="desktop-advert">
	                                {!! $bottomOfNews !!}
	                            </div>
	                           
	                        </div>
	                    </div>
	                </div>
				</div>


				<div class="col-md-3 col-xs-12 div_border">
					<div class="sidebar large-sidebar">
						<div class="widget features-slide-widget">
	                        <div class="advertisement">
	                            <div class="desktop-advert">
	                                {!! $sitebarTop !!}
	                            </div>
	                        </div>
	                    </div>
						<!-- sidebar -->
						@include('frontend.layouts.news')
						<div class="widget features-slide-widget">
	                        <div class="advertisement">
	                            <div class="desktop-advert">
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
