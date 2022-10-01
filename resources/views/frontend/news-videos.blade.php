@extends('frontend.layouts.master')
@section('title')
    {{(request()->segment(1) == 'en' ? 'Video Gallery' : 'ভিডিও গ্যালারি ')}} | {{Config::get('siteSetting.title')}}
@endsection
@section('Metatag') @endsection
        <?PHP
function banglaDate($date){
    $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

    $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );
    $formatBng = Carbon\Carbon::parse($date)->format('j F, Y');
    $convertedDATE = str_replace($engDATE, $bangDATE, $formatBng);
    return $convertedDATE;
    }
?>
@section('content')
@php $lang = (request()->segment(1) == 'en' ? request()->segment(1) : 'bd'); 
$date = Carbon\Carbon::parse(now())->format('Y-m-d H:i:s'); @endphp
    <section class="ticker-news category">

        <div class="container">
            <div class="category-title">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="category-title">
                            <span class="breaking-news" id="head-title"> {{(request()->segment(1) == 'en' ? 'Video Gallery' : 'ভিডিও গ্যালারি ')}}</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="block-wrapper">

        <div class="container section-body">
        	<?php $section = 1; $category_name ='category_'.$lang; ?>
        	@foreach($categories as $category)
        		<?php $videos = DB::table('news')
        			->join('categories', 'news.category', '=', 'categories.id')
        			->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
        			->where('news.category', $category->id)
        			->where('news.type', 3)
        			->where('news.lang', '=', $lang)
		            ->where('news.status', '=', 'active')
		            ->where('publish_date', '<=', $date)
        			->select('news.*','media_galleries.source_path')->take(5)->get();
        		$i = 1;
                ?>
                	<div class="row">
                @foreach($videos  as $video)
	        		@if($i ==1)
				        	<div class="title-section">
							<h1><span class="video">{{$category->$category_name}}</span></h1>
						</div>
			        @endif
			        	@if($i <=1 && $section <=1 )
			        	<?php $section++; ?>
						<div class="col-md-6">
							<div class="news-post video-post">
								<img alt="" src="{{ asset('upload/images/thumb_img/'. $video->source_path)}}">
								<a href="{{route('news_details', $video->id)}}" class="play-link"><i class="fa fa-play-circle-o"></i></a>
								<div class="hover-box">
									<h2><a href="{{route('video.watch', [$video->id])}}">{{Str::limit($video->news_title, 40)}} </a></h2>
									<ul class="post-tags">
										<li><i class="fa fa-clock-o"></i>{{banglaDate($video->publish_date)}}</li>
									</ul>
								</div>
							</div>
						</div>
						@else
						<div class="col-md-3">
							<div class="news-post video-post">
								<img alt="" src="{{ asset('upload/images/thumb_img/'. $video->source_path)}}">
								<a href="{{route('news_details', $video->id)}}" class="play-link"><i class="fa fa-play-circle-o"></i></a>
								<div class="hover-box">
									<h2><a href="{{route('video.watch', [$video->id])}}">{{Str::limit($video->news_title, 40)}}</a></h2>
									<ul class="post-tags">
										<li><i class="fa fa-clock-o"></i>{{banglaDate($video->publish_date)}}</li>
									</ul>
								</div>
							</div>
						</div>
						@endif
					<?php $i++; ?>
				@endforeach
					</div>
			@endforeach

		</div>

</section>
@endsection
