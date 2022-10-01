<!-- breaking news -->
<section @if($section->layout_width == 'full') style="background:{{$section->background_color}} url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed; background-size: cover;" @endif>
    <div class="container" style="padding: 8px 8px">
        <div class="row">
            
            <div class="col-md-12">
                <section class="ticker-news">
                    <div class="ticker-news-box" style=" box-shadow:0 0 6px -3px {{ $section->text_color }};">
                        <span class="breaking-news">{{$section->title}} </span>
                        <?php $get_breaking_news = App\Models\News::where('breaking_news', 1)->where('lang', $lang)->where('publish_date', '<=', $date)->where('status', '=', 'active')->select('news_title', 'news.category', 'news_slug', 'created_at')->take($section->item_number)->orderBy('id', 'DESC')->get(); ?>
                        <ul id="js-news">
                            @if(count($get_breaking_news)>0)
                                @foreach($get_breaking_news as $breaking_news)
                                    <li class="news-item"><a style="color:{{ $section->text_color }}" href="{{route('newsDetails', [$breaking_news->getCategory->cat_slug_en, $breaking_news->news_slug])}}">{{$breaking_news->news_title}}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </section>
            </div>
            
        </div>
    </div>
</section>
<!-- End breaking news -->
