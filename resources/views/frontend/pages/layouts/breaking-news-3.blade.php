<div class="{{$section_item->colmd}} pps" style="display: flex;align-items: center;flex-direction: row;">
    <div style="font-weight: bold;display: block;width: auto;position: absolute;background:{{$section_item->background_color}};color:{{$section_item->text_color}};margin: 0;padding: 9px;left: -1px;z-index: 999;">{{$section->title}}</div>
    <?php $i = 1;?>
    <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();" style="padding:8px 0;font-size: 15px;">
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
            <i style="margin-left: 15px;color: {{$section_item->background_color}};" class="fa fa-angle-double-right" aria-hidden="true"></i> 
            <a style="color:{{$section_item->bt_text}}" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                {{$section_news->news_title}}
            </a>
            <?php $i++; ?>
        @endforeach
    </marquee>
</div>