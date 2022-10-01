@extends('frontend.layouts.master')
@section('title')
    {{Request::get('q')}}
@endsection
@section('Metatag') @endsection

@section('content')
<?PHP

$get_ads = App\Models\Addvertisement::where('page', 'search_page')->where('status', 1)->get();
$top_head_right = $topOfNews = $middleOfNews = $bottomOfNews = $sitebarTop = $siteBarMiddle = $sitebarBottom = null ;
foreach ($get_ads as $ads){
    if($ads->position == 2){
            $top_head_right = $ads->add_code;
        }elseif($ads->position == 3){
            $topOfNews = $ads->add_code;
        }elseif($ads->position == 4){
            $middleOfNews = $ads->add_code;
        }elseif($ads->position == 5){
            $bottomOfNews = $ads->add_code;
        }elseif($ads->position == 6){
            $sitebarTop = $ads->add_code;
        }elseif($ads->position == 7){
            $sitebarMiddle = $ads->add_code;
        }elseif($ads->position == 8){
            $sitebarBottom = $ads->add_code;
        }else{
            echo '';
        }
}

function banglaDate($date){
    $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

    $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );
    $formatBng = Carbon\Carbon::parse($date)->format('j F, Y');
    $convertedDATE = str_replace($engDATE, $bangDATE, $formatBng);
    return $convertedDATE;
    }
?>
    <!-- block-wrapper-section================================================== -->
        
    <section class="ticker-news category">

        <div class="container">
            <div class="category-title">
                <div class="row">
                <div class="col-sm-8">
                    <div class="category-title">
                        <span class="breaking-news" id="head-title">Search Result ({{$search_results->total()}})</span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="rightAds">
                        {!! $top_head_right !!}
                    </div>
                </div>
            </div>
            </div>
        </div>

    </section>

    <section class="block-wrapper">
        <div class="container section-body">
            <div class="row">
                <div class="col-sm-9 divrigth_border">
                     <div class="grid-box">
                        <div class="row">
                                <div class="col-md-12 pps">
                                    <div class="advertisement">
                                        <div class="desktop-advert">
                                           {!! $topOfNews !!}
                                        </div>
                                    </div>
                                    <form action="{{route('search_result')}}" method="get" class="jumbotron" class="subscribe-form">
                                    <input type="text" name="q" value="{{Request::get('q')}}" style="width: 85%; padding: 10px;" id="subscribe" placeholder="Email">
                                    <button id="submit-subscribe" style="padding:10px;">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </form>
                                </div>
                                @foreach($search_results as $search_result)
                                    <div class="col-md-6 col-xs-12 pps">
                                        <a href="{{route('newsDetails', [$search_result->getCategory->cat_slug_en, $search_result->id])}}" class="mmb pps">
                                            <div class="col-md-4 col-xs-4 mix777 pps">
                                                @if(Config::get('siteSetting.lazyload'))
                                                    @if($search_result->source_path)
                                                    <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/thumb_img/'. $search_result->source_path)}}"  alt="{{$search_result->news_title}}">
                                                    @else
                                                    <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$search_result->news_title}}">
                                                    @endif
                                                @elseif($search_result->source_path)
                                                <img src="{{ asset('upload/images/thumb_img/'. $search_result->source_path)}}" alt="{{($search_result->news_title)}}">
                                                @else
                                                <img src="{{ asset('upload/images/default.jpg')}}"  alt="{{$search_result->news_title}}">
                                                @endif
                                            </div>
                                            <div class="col-md-8 col-xs-8 grid77 pps">
                                                <p style="color:#666">{{$search_result->news_title}}</h2>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                        </div>
                    </div>
                    <!-- pagination box -->
                    <div class="pagination-box">
                       {{$search_results->appends(request()->query())->links()}}
                    </div>
                    <!-- End Pagination box -->

                    <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="advertisement">
                                    <div class="desktop-advert">
                                        {!! $bottomOfNews !!}
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                </div>

                <div class="col-sm-3">
                    <div class="sidebar large-sidebar">
                        <div class="widget features-slide-widget">
                            <div class="advertisement">
                                <div class="desktop-advert">
                                    {!! $sitebarTop !!}
                                </div>
                            </div>
                        </div>
                        <!-- sidebar -->
                        @include('frontend.layouts.news')

                        <div class="widget features-slide-widget">
                            <div class="advertisement">
                                <div class="desktop-advert">
                                    {!! $sitebarBottom !!}
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End block-wrapper-section -->

@endsection
