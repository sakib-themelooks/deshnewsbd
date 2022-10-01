@php
    $feature_section_news = DB::table('news')
            ->join('categories', 'news.category', '=', 'categories.id')
            ->leftJoin('sub_categories', 'news.subcategory', '=', 'sub_categories.id')
            ->leftJoin('media_galleries', 'news.thumb_image', '=', 'media_galleries.id')
            ->where('news.breaking_news', 1)
            ->limit($section->item_number)
            ->orderBy('news.id', 'DESC')
            ->where('news.status', '=', 'active')->where('publish_date', '<=', $date)->where('news.lang', '=', $lang)->select('news.*', 'categories.category_bd', 'categories.cat_slug_en', 'sub_categories.subcategory_bd', 'categories.category_en', 'sub_categories.subcategory_en', 'media_galleries.source_path', 'media_galleries.title')->get();
@endphp
<style>
.news-post.standard-post2.xxx {
    background: transparent;
}
.post-gallery.kera img {
    max-height: 250px;
}
ul.list-posts.v22 img {
    width: 100%;
}
.post-titles h2 {
    font-size: 16px;
    line-height: 28px;
    margin: 0;
    padding: 10px 0;
    color: black;
}
.pps {
    padding: 0 !important;
    margin: 0;
}
.grid-box .news-post, .grid-box ul.list-posts {
    margin: 5px;
    padding: 0;
}
ul.list-posts>li,
.post-content123 h2,
.standard-post2 .post-title {
    background: #eee;
}
.standard-post2 .post-title h2 {
    color: #333;
    font-size: 19px;
    font-family: shurjo;
    height: 46px;
    line-height: initial;
    margin: 0 0 5px;
    font-weight: normal;
    overflow: hidden;
    text-decoration: none;
}
.sidebar .tab-posts-widget .tab-pane ul.list-posts>li img {
    max-width: 120px;
}
ul.list-posts>li img {
    width: 100%;
    margin-right: 10px;
    float: left;
}
.sidebar.large-sidebar .tab-posts-widget .tab-pane ul.list-posts li {
    padding-left: 0;
    padding-right: 0;
    display: flex;
    flex-direction: row;
    align-items: center;
}
.news-post.standard-post24 h2,
ul.list-posts>li .post-content h2 {
    color: #333;
    font-family: shurjo;
    line-height: 25px;
    margin: 0;
    font-size: 20px;
    max-height: 50px;
    overflow: hidden;
    margin-bottom: 0;
    padding-left: 10px;
}
.sidebar .tab-posts-widget ul.nav-tabs li.active a {
    border: none;
    background: #072a3d;
}
.sidebar .tab-posts-widget ul.nav-tabs li a {
    font-size: 20px;
}
.sidebar .tab-posts-widget ul.nav-tabs li a {
    background: #ed1c24;
}

.list-posts li {
    position: relative;
    display: flex;
    align-items: center;
}
.news-post.standard-post24 {
    background: #eeeeee;
    display: flex;
    align-items: center;
    margin-top: 10px;
}
.tab-content {
    overflow-y: scroll;
    max-height: 400px;
    overflow-x: hidden;
}
</style>
@if(count($feature_section_news)>0)
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>

  @if($section->layout_width == 'box')
    <div class="container" style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover; border-radius: 3px; padding:5px;"> @endif
        <div class="row">
            <div class="col-md-9 pps section-body divrigth_border" id="sticky-conent">
                @if(count($feature_section_news)>0)
                <div class="row">
                    <div class="grid-box">
                        <?php $i = 1;?>
                        @foreach($feature_section_news as $section_news)
                            @if($i==1)
                                <div class="col-md-4 col-xs-12 pps">
                                    <div class="news-post standard-post2 ">
                                        <a href="{{route('newsDetails', [$section_news->cat_slug_en, $section_news->id])}}">
                                            <div class="col-md-12 col-xs-12 post-gallery pps">
                                                @if($section_news->source_path)
                                                <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/news/'. $section_news->source_path)}}"  alt="">
                                                @else
                                                <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                                @endif
                                                @if($section_news->type == 3)
                                                    <a class="play-link" href="{{route('newsDetails', [$section_news->cat_slug_en, $section_news->id])}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($section_news->type == 4)
                                                    <a class="play-link" href="{{route('newsDetails', [$section_news->cat_slug_en, $section_news->id])}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                            </div>
                                            <div class="col-md-12 col-xs-12 post-title pps">
                                                <h2>{{($section_news->news_title)}}</h2>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-4 col-xs-6 pps">
                                    <div class="news-post standard-post2">
                                        <a href="{{route('newsDetails', [$section_news->cat_slug_en, $section_news->id])}}">
                                            <div class="post-gallery">
                                                @if($section_news->source_path)
                                                <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/news/'. $section_news->source_path)}}"  alt="">
                                                @else
                                                <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                                @endif
                                                @if($section_news->type == 3)
                                                    <a class="play-link" href="{{route('newsDetails', [$section_news->cat_slug_en, $section_news->id])}}"><i class="fa fa-play-circle-o"></i></a>
                                                @elseif($section_news->type == 4)
                                                    <a class="play-link" href="{{route('newsDetails', [$section_news->cat_slug_en, $section_news->id])}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                                @else @endif
                                            </div>
                                            <div class="post-title">
                                                <h2>{{($section_news->news_title)}}</h2>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            <?php $i++;?>
                        @endforeach
                    </div>
                </div>
                @endif
                
                {!! config('siteSetting.code2') !!}
            </div>
            <div class="col-md-3 col-xs-12 section-body pps" id="sticky-conent">
                {!! config('siteSetting.code3') !!}
                <div class="sidebar large-sidebar">
                    @include('frontend.layouts.sitebar')
                </div>
                
            </div>
        </div>
        @if($section->layout_width == 'box')
    </div>@endif
</section>
@endif
