<h1 class="{{$section_item->bt_text}}">@if($section_news->sub_1)<span class="t-red">{{$section_news->sub_1}}</span>@endif{{$section_news->news_title}}</h1>
@if($section_item->device == '1')
<ul class="post-tags">
    <li class="post1"><i class="fa fa-tags"></i>{{$section_news->category_bd}}</li>
    <li class="post2"><i class="fa fa-clock-o"></i>{{banglaDate($section_news->publish_date)}}</li>
</ul>
@endif