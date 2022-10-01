<?php 
$get_ads = App\Models\Addvertisement::where('page', 'news-details')->inRandomOrder()->where('status', 1)->get();
    function banglaDate($date){
        $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'PM', 'AM', 'second', 'minutes', 'ago', 'hours', 'hour',   'days', 'weeks',  'ago', 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

        $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০', 'পিএম', 'এএম', 'সেকেন্ট', 'মিনিট', 'আগে', 'ঘন্টা', 'ঘন্টা', 'দিন', 'সপ্তাহ',  'পূর্বে', 'জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );
        $convertedDATE = str_replace($engDATE, $bangDATE, $date);
        return $convertedDATE;
    }
?>
@foreach($more_news as $index => $get_news)
@if($index == $newsNo)
    <div class="col-md-12 col-xs-12 pps"><div class="news_divider"><div class="divider_line"></div><div class="divider_icon fa fa-chevron-down"> </div></div></div>
    <!-- single-post box -->
    <div class="single-post-box">
        <div class="block">{!! config('siteSetting.code14') !!}</div>
        <div class="herabox pps">
            @if($get_news->sub_1) 
                <a href="{{route('newsDetails', [$get_news->categoryList->slug, $get_news->id])}}">
                    <h5>{{$get_news->sub_1}}</h5>
                </a> 
            @endif
            
            <a href="{{route('newsDetails', [$get_news->categoryList->slug, $get_news->id])}}">
                <h1>{{$get_news->news_title}}</h1>
            </a> 

            @if($get_news->sub_2)
                <a href="{{route('newsDetails', [$get_news->categoryList->slug, $get_news->id])}}">
                    <h6>{{$get_news->sub_2}}</h6>
                </a> 
            @endif
            
            @if($get_news->thumb_name)
            @else
            <div class="flex align-c m-t-1">
                <div class="author m-r-1 m-none">
                    @if($get_news->reporter->photo)
                        <a href="{{route('newsDetails', [$get_news->categoryList->slug, $get_news->id])}}">
                            <img class="border-radius-50" src="{{asset('upload/images/users/'.$get_news->reporter->photo)}}"  alt="{{$get_news->reporter->name}} {{$get_news->reporter->lname}}">
                        </a>
                    @else
                        <a href="{{route('newsDetails', [$get_news->categoryList->slug, $get_news->id])}}">
                            <img class="border-radius-50" src="{{ asset('upload/images/author.jpg')}}"  alt="">
                        </a>
                    @endif
                </div>
                <div class="author-name">
                    @if($get_news->userx)
                    <p class="author m-0">{{$get_news->userx}}</p>
                    @else
                    <p class="author m-0">{{$get_news->reporter->name}} {{$get_news->reporter->lname}}</p>
                    @endif
                    <p class="news-time m-0">প্রকাশিত: {{banglaDate(Carbon\Carbon::parse($get_news->publish_date)->format('d F, Y,  h:i A'))}}</p>
                </div>
            </div>
            @endif
            
            <div class="col-md-12 col-xs-12 pps m-b-1">
                <div class="share-box flex align-c">
                    <a target="_blank" href="http://www.facebook.com/sharer.php?u={{route('newsDetails', [$get_news->getCategory->slug, $get_news->id])}}"><i class="fa fa-facebook"></i></a>
                    <a target="_blank" href="https://twitter.com/share?url={{route('newsDetails', [$get_news->getCategory->slug, $get_news->id])}}&amp;text={!! $get_news->news_title !!}"><i class="fa fa-twitter"></i></a>
                    <a target="_blank" href="https://api.whatsapp.com/send?text={{route('newsDetails', [$get_news->getCategory->slug, $get_news->id])}}&amp;title={!! $get_news->news_title !!}"><i class="fa fa-whatsapp"></i></a>
                    <a target="_blank" href="{{route('newsPrint', $get_news->id)}}"><i class="fa fa-print"></i></a>
                    <a target="_blank" href="#" class="m-none rss"><i class="fa fa-newspaper-o" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <div class="block">{!! config('siteSetting.code15') !!}</div>
        <div class="post-gallery videos">
            
            @if($get_news->type == 2)
                <ul class="bxslider">
                    @foreach($get_news->attachFiles as $attachFile)
                    <li><img src="{{asset('upload/file/'.$attachFile->source_path)}}" alt="Bangla Today News"></li>
                    @endforeach
                </ul>
            @elseif($get_news->type == 3)
                @foreach($get_news->attachFiles as $attachFile)
                <video width="100%"  controls>
                    <source src="{{asset('upload/file/'.$attachFile->source_path)}}" type="video/mp4">
                </video>
                @endforeach
            @else
                
                @if($get_news->thumb_name)
                    <div class="videoWrapper"><iframe class="video" src="https://www.youtube-nocookie.com/embed/{{$get_news->thumb_name}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                @elseif($get_news->thumb_url)
                    <img src="{{$get_news->thumb_url}}"  alt="{{$get_news->title}}">
                @elseif($get_news->image)
                <img title="{{$get_news->title}}" src="@if($get_news->image){{asset('upload/images/news/'.$get_news->image->source_path)}}@else{{asset('upload/images/default.jpg')}}@endif" alt="{{$get_news->news_title}}">
                @else
                <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$get_news->title}}">
                @endif
            @endif
        </div>
        @if($get_news->image)<span class="printx image-caption">{{$get_news->image->title}}</span>@endif
        <div class="block">{!! config('siteSetting.code16') !!}</div>
        <div class="description">
            @php 

            $ads = $get_ads->toArray();
          
            $adNo = 0; $contentBlock = explode("</p>", $get_news->news_dsc); @endphp
            @foreach($contentBlock as $index => $content)
                
                {!! $content  !!}
    
                @if(($index+1) % 2 == 0 && $adNo < count($ads))
                    @if( $ads[$adNo]['adsType'] == 'image')
                      <div class="appdpp text-center"><a href="{{ $ads[$adNo]['redirect_url'] }}">
                      <img src="{{ asset('upload/marketing/'.$ads[$adNo]['image']) }}" alt="">
                      </a></div>
                     @elseif($ads[$adNo]['adsType'] == 'google')
                        {!! $ads[$adNo]['add_code'] !!}
                    @else 
                       
                    @endif
                    
                    @php $adNo++; @endphp
                @endif
                   
            @endforeach
        </div>
        <div class="block">{!! config('siteSetting.code17') !!}</div>
        <!-- End single-post box -->
        @if($get_news->keywords)
        <div class="homesearch">
			<?php $tag_array = explode(',', $get_news->keywords); ?>
			@foreach($tag_array as $tag)
				<a href="{{ url('search?q='.$tag) }}">{{$tag}}</a>
			@endforeach
		</div>
		@endif
        <div class="block">{!! config('siteSetting.code18') !!}</div>
        <div class="col-md-12 col-xs-12 pps flex align-c share-box">
           <a class="m-none"  href="http://www.facebook.com/sharer.php?u={{route('newsDetails', [$get_news->getCategory->slug, $get_news->id])}}" target="_blank"><i class="fa fa-facebook"></i></a>
           <a class="m-none" href="https://twitter.com/share?url={{route('newsDetails', [$get_news->getCategory->slug, $get_news->id])}}&amp;text={!! $get_news->news_title !!}" target="_blank"><i class="fa fa-twitter"></i></a>
           <a class="m-none" href="https://api.whatsapp.com/send?text={{route('newsDetails', [$get_news->getCategory->slug, $get_news->id])}}&amp;title={!! $get_news->news_title !!}" target="_blank"><i class="fa fa-whatsapp"></i></a>
           <a href="https://www.linkedin.com/shareArticle?mini=true&url={{route('newsDetails', [$get_news->getCategory->slug, $get_news->id])}}" target="_blank"><i class="fa fa-linkedin"></i></a>
           <a href="https://pinterest.com/pin/create/button/?url={{route('newsDetails', [$get_news->getCategory->slug, $get_news->id])}}" target="_blank"><i class="fa fa-pinterest"></i></a>
           <a href="https://mail.google.com/mail/u/0/?to&su={{$get_news->news_title}}&body={{route('newsDetails', [$get_news->getCategory->slug, $get_news->id])}}&bcc&cc&fs=1&tf=cm" target="_blank"><i class="fa fa-envelope"></i></a>
           <a target="_blank" href="{{route('newsPrint', $get_news->id)}}"><i class="fa fa-print"></i></a>
        </div>
        <div class="block">{!! config('siteSetting.code19') !!}</div>
        @if(count($more_news)>0)
        <!-- more news box -->
        <div class="col-md-12 col-xs-12 pps m-t-1">
            <h1 class="box_text_color-1 p-l-10 mp-0">
                @if($get_news->subcategory){{$get_news->subcategoryList->subcategory_bd}}
                @else{{$get_news->categoryList->category_bd }}
                @endif
                {{$siteSetting->lang5}}
            </h1>
            <div class="col-md-12 col-xs-12 pps mix1">
                @foreach($more_news as $news)
                    <div class="col-md-3 col-xs-12 mmb">
                        <a href="{{route('newsDetails', [$news->categoryList->slug, $news->id])}}" class="news-post standard-post2">
                            <div class="col-xs-4 col-md-12 img_130 videos pps">
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
                            <div class="col-xs-8 col-md-12 pps mp-l-1">
                                <h1 class="box_text_color-1">{{($news->news_title)}}</h1>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- End carousel box -->
        @endif
        <div class="block">{!! config('siteSetting.code20') !!}</div>
    </div>
@break;
@endif
@endforeach