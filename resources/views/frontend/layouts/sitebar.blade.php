 <?php
    $date = Carbon\Carbon::parse(now())->format('Y-m-d H:i:s');
    $lang = (request()->segment(1) == 'en' ? request()->segment(1) : 'bd');
$recent_news = DB::table('news')
    ->join('categories', 'news.category', '=', 'categories.id')
    
    ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
    ->where('news.status', 'active')
    ->limit(12)
    ->orderBy('news.publish_date', 'DESC')
    ->where('news.lang', $lang)->where('publish_date', '<=', $date)
    ->select('news.*','categories.category_bd', 'categories.cat_slug_en', 'media_galleries.source_path', 'media_galleries.title')->get();

    $popular_news_day = App\Models\SiteSetting::where('type', 'popular_news_count_day')->first()->value;

    $popular_news_date = Carbon\Carbon::parse(now())->subDays($popular_news_day)->format('Y-m-d '. '23:59:59');

$popular_news =  DB::table('news')
    ->join('categories', 'news.category', '=', 'categories.id')
    
    ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
    ->where('news.status', 'active')
    ->where('news.lang', $lang)->where('publish_date', '<=', $date)->where('publish_date', '>=', $popular_news_date)
    ->orderBy('view_counts', 'DESC')
    ->select('news.*','categories.category_bd', 'categories.cat_slug_en', 'media_galleries.source_path')->take(12)->get();

?>

    <div class="widget tab-posts-widget">

        <ul class="nav nav-tabs" id="myTab">
            <li class="active">
                <a href="#option1" data-toggle="tab">সর্বশেষ</a>
            </li>
            <li>
                <a href="#option2" data-toggle="tab">জনপ্রিয়</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="option1">
                <ul class="list-posts">
                    @foreach($recent_news as $recent)
                    <li>
                        @if($recent->source_path)
                        <img src="{{ asset('upload/images/thumb_img/'. $recent->source_path)}}"  alt="">
                        @else
                        <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                        @endif
                        <div class="post-content">
                            <h2><a href="{{route('newsDetails', [$recent->cat_slug_en, $recent->id])}}">{{Str::limit($recent->news_title, 60)}}</a></h2>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="tab-pane " id="option2">
                <ul class="list-posts">
                    @foreach($popular_news as $popular)
                        <li>
                            @if($popular->source_path)
                            <img src="{{ asset('upload/images/thumb_img/'. $popular->source_path)}}"  alt="">
                            @else
                            <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                            @endif
                            <div class="post-content">
                                <h2><a href="{{route('newsDetails', [$popular->cat_slug_en, $popular->id])}}">{{Str::limit($popular->news_title, 60)}}</a></h2>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    
    @if(Request::is('/'))
    @php $poll = App\Models\Poll::with(['pollOptions'])->where('status', 1)->orderBy('position', 'asc')->whereDate('start_date', '<=', Carbon\Carbon::now())->whereDate('end_date', '>=', Carbon\Carbon::now())->first(); @endphp
    @if($poll)
    <div class="sidebar large-sidebar">
        <div class="widget features-slide-widget">
            <div class="titles-section"><h1><img src="{{ asset('upload/images/cat_icon.png')}}"  alt=""> আপনার মতামত দিন</h1>
            <a></a>
            </div>
            <div style="background: {!! $poll->bg_color !!}; color: {!! $poll->text_color !!}; margin:0; padding:0;">
                <form action="{{url('/')}}" method="get" id="polling">
                    <input type="hidden" name="poll_id" value="{{$poll->id}}">
                   <h2 style="margin-top: 0; font-size: 15px;line-height: initial;">
                       <!-- <a style="color: {!! $poll->text_color !!};" href="{{route('poll_details', $poll->slug)}}"></a>
                       <a class="dnone-m" href="{{route('pollings')}}"><i class="fa fa-arrow-circle-right"></i></a> -->
                       {{$poll->question_title}}</h2>
                  
                    @if(count($poll->pollOptions)>0)
                        @php $total_votes =  $poll->pollOptions->sum('votes'); @endphp
                        @foreach($poll->pollOptions as $pollOption)
                        @php 
                        $percent = ($total_votes > 0) ? round(($pollOption->votes/$total_votes)  * 100, 2) : 0;
                        @endphp
                            <div class="progress" style="position:relative;">
                              <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50"
                              aria-valuemin="0" aria-valuemax="100" style="width:{{ $percent }}%">
                                <label style="position:absolute;top: 0;left: 5px; color: {!! $poll->text_color !!}" for="option{{$pollOption->id}}">
                                <input required type="radio" value="{{$pollOption->id}}" name="pollOption" id="option{{$pollOption->id}}"> {{$pollOption->option}} </label><span style="position: absolute;top: 0;right:5px;color: {!! $poll->text_color !!};">{{ $percent }}%</span>
                              </div>
                            </div>
                        @endforeach
                        <p><button class="btn btn-success" style="background: #144c66;border: #144c66;width: 100%;">ভোট দিন</button></p>
                    @endif
                </form>
            </div>
        </div>
    </div>
    @endif
    @endif
    @if(Route::currentRouteName() == 'category')
        <?php         
        $get_most_views =  DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->limit(5);
            if(Request::segment(3)){
                $get_most_views =$get_most_views->where('cat_slug_en', Request::segment(3));
                
            }else{
               $get_most_views =$get_most_views->where('categories.cat_slug_en',Request::segment(2));
            }
            
            $get_most_views = $get_most_views->orderBy('news.view_counts', 'DESC')->where('news.status', '=', 1)
            ->select('news.*','media_galleries.source_path', 'categories.cat_slug_en', 'media_galleries.title')->get();
        ?>
        <div class="widget features-slide-widget">
            <div class="title-section">
                <h1><span>এই বিভাগের সর্বোচ্চ পঠিত</span></h1>
            </div>
            <ul class="list-posts">
                @foreach($get_most_views as $most_views)
                    <li>
                        <img src="{{ asset('upload/images/thumb_img/'. $most_views->source_path)}}" alt="">
                         @if($most_views->type == 3)
                                <a class="play-link" href="{{route('newsDetails', [$most_views->cat_slug_en, $most_views->id])}}"><i class="fa fa-play-circle-o"></i></a>
                                @elseif($most_views->type == 4)
                                    <a class="play-link" href="{{route('newsDetails', [$most_views->cat_slug_en, $most_views->id])}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                @else @endif
                        <div class="post-content">
                            <h2><a href="{{route('newsDetails', [$most_views->cat_slug_en, $most_views->id])}}">{{Str::limit($most_views->news_title, 60)}}</a></h2>
                            <ul class="post-tags">
                                 <li><i class="fa fa-eye"></i>{{$most_views->view_counts}}</li>
                                <li><i class="fa fa-clock-o"></i>{{banglaDate($most_views->publish_date)}}</li>
                            </ul>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(!Request::is('/'))
        <div class="title-section">
            <h1><span>এক ক্লিকে বিভাগের খবর</span></h1>
        </div>
        <div class="map">
            @include('frontend.map');
        </div>
    
        @include('frontend.layouts.deshjure')
    @endif

 