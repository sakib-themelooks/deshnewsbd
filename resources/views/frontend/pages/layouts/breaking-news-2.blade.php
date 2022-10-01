<div class="{{$section_item->colmd}}" style="display: flex;align-items: center;flex-direction: row;position: fixed;bottom: 0;z-index: 9;background: {{$section_item->bg_text}};">
    <div style="font-weight: bold;display: block;width: auto;position: absolute;background:{{$section_item->background_color}};color:{{$section_item->text_color}};margin: 0;padding: 9px;left: -1px;z-index: 999;">{{$section->title}}</div>
    <?php $get_breaking_news = App\Models\News::where('breaking_news', 1)->where('lang', $lang)->where('publish_date', '<=', $date)->where('status', '=', 'active')->select('news_title', 'news.category', 'id', 'created_at')->take($section_item->item_number)->orderBy('id', 'DESC')->get(); ?>
    <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" style="padding:8px 0;font-size: 15px;">
    @if(count($get_breaking_news)>0)
        @foreach($get_breaking_news as $breaking_news)
            <i style="margin-left: 15px;color: {{$section_item->background_color}};" class="fa fa-angle-double-right" aria-hidden="true"></i> <a style="color:{{$section_item->bt_text}}" href="{{route('newsDetails', [$breaking_news->getCategory->slug, $breaking_news->id])}}">{{$breaking_news->news_title}}</a>
        @endforeach
    @endif
    </marquee>
</div>
