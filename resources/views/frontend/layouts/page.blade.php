<?PHP
function banglaDate($date){

    $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'second', 'hours from now',  'days', 'weeks',  'ago', 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

    $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০', 'সেকেন্ট', 'ঘন্টা পূর্বে', 'দিন', 'সপ্তাহ',  'পূর্বে', 'জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );

     $formatBng = Carbon\Carbon::parse($date)->format('j F, Y');
    $convertedDATE = str_replace($engDATE, $bangDATE, $formatBng);
    return $convertedDATE;
    }
?>
<style>
.standard-post2 .post-title {
    background: #eee;
}
.grid-box .news-post, .grid-box ul.list-posts {
    padding: 0;
}
</style>
@if($find_page)
    @if($find_page->template == 1)
        {!! $find_page->page_dsc !!}
    @elseif($find_page->template == 2)
        <?php 
        $lang = (request()->segment(1) == 'en' ? request()->segment(1) : 'bd'); 
        $date = Carbon\Carbon::parse(now())->format('Y-m-d H:i:s'); 
        $get_news = App\Models\News::with(['categoryList', 'image'])->where('lang', '=', $lang)->where('publish_date', '<=', $date)->orderBy('id', 'DESC')->where('status', '=', 'active')->paginate(25) ?>

        <div class="row">
            <div class="grid-box">
                <?php $i = 1;?>
                    @foreach($get_news as $news)
                        @if(Request::get('page') <= 1)
                            @if($i==1)
                                <div class="col-md-6 col-sm-6" >
                                    <div class="news-post standard-post2">
                                        <div class="post-gallery">
                                            <img src="{{ asset('upload/images/news/'. $news->image->source_path)}}" alt="">
                                             @if($news->type == 3)
                                                <a class="play-link" href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}"><i class="fa fa-play-circle-o"></i></a>
                                            @elseif($news->type == 4)
                                                <a class="play-link" href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}"><i class="fa fa-headphones" aria-hidden="true"></i></a>
                                            @else @endif
                                        </div>
                                        <div class="post-title box_title">
                                            <h2><a href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}">{{ Str::limit($news->news_title, 70)}} </a></h2>
                                            <span>{!! Str::limit(strip_tags($news->news_dsc), 150)!!}</span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-md-3 col-sm-3">
                                    <div class="news-post standard-post2">
                                        <div class="post-gallery">
                                            <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}" alt="">

                                        </div>
                                        <div class="post-title">
                                            <h2><a href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}">{{ ($news->news_title)}} </a></h2>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="col-md-3 col-sm-3">
                                <div class="news-post standard-post2">
                                    <div class="post-gallery">
                                        <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}" alt="">

                                    </div>
                                    <div class="post-title">
                                        <h2><a href="{{route('newsDetails', [$news->getCategory->cat_slug_en, $news->id])}}">{{ ($news->news_title)}} </a></h2>

                                    </div>
                                </div>
                            </div>

                        @endif
                     <?php $i++;?>
                    @endforeach

            </div>
        </div>
        <!-- pagination box -->
        <div class="pagination-box">
            {{$get_news->links()}}
        </div>
    @elseif($find_page->template == 3)
       <?php $reporters = DB::table('users')->leftJoin('reporters', 'users.id', 'reporters.user_id')->where('users.role_id', 'reporter')->orderBy('reporters.position', 'ASC')->where('users.status', 'active')->get(); ?>
 
        <div class="row">
            @foreach($reporters as $reporter)

            <div class="col-md-3  col-xs-6" id="author-list">
                <div class="news-post image-post default-size">
                    <img src="{{asset('upload/images/users')}}/{{($reporter->photo) ? $reporter->photo : 'default.png' }}" alt="{{$reporter->username }}">
                    <div class="hover-box">
                        <div class="inner-hover top-line" style="display:block !important ">
                            <h2><a href="{{route('reporter.publicProfile', $reporter->username)}}">{{$reporter->name .' '.$reporter->lname }}</a></h2>
                            <ul class="post-tags">
                                <li></li>
                                <li style="font-size: 15px"><i class="fa fa-tags"></i>{{($reporter->designation) ? $reporter->designation : "Reporter" }}</li>
                            </ul>
                            <p><ul class="social-icons">
                                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a><a class="twitter" href="#"><i class="fa fa-twitter"></i></a><a class="rss" href="#"><i class="fa fa-rss"></i></a><a class="google" href="#"><i class="fa fa-google-plus"></i></a><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a><a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @elseif($find_page->template == 4)

    @else

    @endif
@endif
