<?php
    $date = Carbon\Carbon::parse(now())->format('Y-m-d H:i:s');
    $lang = (request()->segment(1) == 'en' ? request()->segment(1) : 'bd');
$recent_news = DB::table('news')
    ->join('categories', 'news.category', '=', 'categories.id')
    ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
    ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
    ->where('news.status', 'active')
    ->limit($section_item->item_number)
    ->orderBy('news.id', 'DESC')
    ->where('news.lang', $lang)->where('publish_date', '<=', $date)
    ->select('news.*','categories.category_bd', 'categories.slug', 'sub_categories.subcategory_bd','media_galleries.source_path', 'media_galleries.title')->get();

    $popular_news_day = App\Models\SiteSetting::where('type', 'popular_news_count_day')->first()->value;

    $popular_news_date = Carbon\Carbon::parse(now())->subDays($popular_news_day)->format('Y-m-d '. '23:59:59');

$popular_news =  DB::table('news')
    ->join('categories', 'news.category', '=', 'categories.id')
    ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
    ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
    ->where('news.status', 'active')
    ->where('news.lang', $lang)->where('publish_date', '<=', $date)->where('publish_date', '>=', $popular_news_date)
    ->orderBy('view_counts', 'DESC')
    ->select('news.*','categories.category_bd', 'categories.slug', 'sub_categories.subcategory_bd','media_galleries.source_path')->take($section_item->item_number)->get();

?>
<div class="{{$section_item->colmd}} col-xs-12" style="margin:{{$section_item->margin}};padding:{{$section_item->padding}};">
    <div class="col-md-12 pps mmb">{!! $section_item->codex !!}</div>
    
    <ul class="col-md-12 pps nav nav-tabs" id="myTab">
        <li class="active">
            <a href="#nexup1" data-toggle="tab" style="color:{{$section_item->text_color}};">{{$section_item->item_title}}</a>
        </li>
        <li>
            <a href="#nexup2" data-toggle="tab" style="color:{{$section_item->text_color}};">{{$section_item->item_sub_title}}</a>
        </li>
    </ul>

    <div class="tab-content col-md-12 pps mmb">
        <div class="tab-pane active" id="nexup1">
            @foreach($recent_news as $recent)
            <a class="col-md-{{$section_item->colxs}} col-xs-12 mmb pps" href="{{route('newsDetails', [$recent->slug, $recent->id])}}">
                <div class="col-md-12 col-xs-12 grid77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    <p>{{$recent->news_title}}</p>
                </div>
            </a>
            @endforeach
        </div>

        <div class="tab-pane " id="nexup2">
            @foreach($popular_news as $popular)
            <a class="col-md-{{$section_item->colxs}} col-xs-12 mmb pps" href="{{route('newsDetails', [$popular->slug, $popular->id])}}">
                <div class="col-md-12 col-xs-12 grid77 pps" style="background:{{$section_item->bg_text}};color:{{$section_item->bt_text}};">
                    <p>{{$popular->news_title}}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
@if(Request::is('/'))
    @php $poll = App\Models\Poll::with(['pollOptions'])->where('status', 1)->orderBy('position', 'asc')->whereDate('start_date', '<=', Carbon\Carbon::now())->whereDate('end_date', '>=', Carbon\Carbon::now())->first(); @endphp
    @if($poll)
    <div class="col-md-12 pps mms">
        <div class="news-title t5 col-md-12 pps"><h1 style="background:{{$section_item->background_color}};color:{{$section_item->text_color}};">Give your opinion</h1></div>
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
                    <p><button class="btn btn-success" style="background: {{$section_item->background_color}};border: #144c66;width: 100%;">Vote now</button></p>
                @endif
            </form>
        </div>
    </div>
    @endif
@endif
</div>