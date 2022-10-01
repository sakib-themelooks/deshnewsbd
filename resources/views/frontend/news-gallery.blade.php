@extends('frontend.layouts.master')
@section('title')
   {{(request()->segment(1) == 'en' ? 'Image Gallery' : 'ছবি গ্যালারি ')}} | {{Config::get('siteSetting.title')}}
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
                            <span class="breaking-news" id="head-title"> {{($lang == 'en' ? 'Image Gallery' : 'ছবি গ্যালারি ')}}</span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <!--<img src="{{ asset('frontend')}}/upload/addsense/add.jpg" height="45">-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="block-wrapper">

        <div class="container section-body">
        	<div class="single-post-box wide-version">
			<div class="article-inpost">
        	<?php $section = 1; $category_name = 'category_'.$lang; ?>
        	
        	@foreach($categories as $catSection => $category)
        		<?php $galleries = DB::table('news')
        			->leftJoin('categories', 'news.category', '=', 'categories.id')
        			->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
        			->where('news.category', $category->id)
        			->where('news.type', 2)
        			->where('news.lang', '=', $lang)
		            ->where('news.status', '=', 'active')
		            ->where('publish_date', '<=', $date)
        			->select('news.*','media_galleries.source_path')->take(5)->get();
        		
                ?>
                @if(count($galleries)>0)
                	<div class="row">
				        <div class="title-section">
							<h1><span class="video">{{$category->$category_name}}</span></h1>
						</div>
			        @foreach($galleries  as $section => $gallery)
			        	@if($catSection <=0 && $section <=0 )
			        	<?php $section++; ?>
						<div class="col-md-6">
							<div class="image-content news-post video-post">
								<div class="image-place">
									<img src="{{ asset('upload/images/thumb_img/'. $gallery->source_path)}}" alt="">
									<div class="hover-image">
										<a class="zoom" href="{{ asset('upload/images/news/'. $gallery->source_path)}}"><i class="fa fa-arrows-alt"></i></a>
									</div>
								</div>
								<div class="hover-box">
									<h2><a href="{{route('gallery.view', [$category->cat_slug_en, $gallery->news_slug])}}">{{Str::limit($gallery->news_title, 40)}}</a></h2>

								</div>
							</div>
						</div>
						@else

						<div class="col-md-3">
							<div class="image-content news-post video-post">
								<div class="image-place">
									<img src="{{ asset('upload/images/thumb_img/'. $gallery->source_path)}}" alt="">
									<div class="hover-image">
										<a class="zoom" href="{{ asset('upload/images/news/'. $gallery->source_path)}}"><i class="fa fa-arrows-alt"></i></a>
									</div>
								</div>
								<div class="hover-box">
									<h2><a href="{{route('gallery.view', [$category->cat_slug_en, $gallery->news_slug])}}">{{Str::limit($gallery->news_title, 40)}}</a></h2>

								</div>
							</div>
						</div>
						@endif
					
					@endforeach
					</div>
				@endif
			@endforeach



</div>
</div>

</div>

</section>
@endsection
