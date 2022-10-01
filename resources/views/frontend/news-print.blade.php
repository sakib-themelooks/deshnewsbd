@extends('frontend.layouts.master')
@section('title'){{$get_news->news_title}} - {{Config::get('siteSetting.site_name')}}
@endsection
@section('MetaTag')
    <meta charset="UTF-8">
    <meta name="name" content="{{$get_news->news_title}} - {{Config::get('siteSetting.site_name')}}">
    <meta name="googlebot-image" content="noindex" />
    <meta name="MSNBot-Media" content="noindex" />
    <meta name="robots" content="noindex" />
@endsection
@section('css')
<style type="text/css">
.printx {
    max-width: 800px;
    margin: auto;
    text-align: center;
}
footer,
header.clearfix.header {
    display: none !important;
}
.print {
    text-align: center;
    display: block;
    margin: 2em auto;
    padding: 0.3em 3em;
}
.printx p {
    margin-bottom: 1em;
    display: block;
}
</style>
@endsection
<?PHP
    function banglaDate($date){
        $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'PM', 'AM', 'second', 'minutes', 'ago', 'hours', 'hour',   'days', 'weeks',  'ago', 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

        $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০', 'পিএম', 'এএম', 'সেকেন্ট', 'মিনিট', 'আগে', 'ঘন্টা', 'ঘন্টা', 'দিন', 'সপ্তাহ',  'পূর্বে', 'জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );
        $convertedDATE = str_replace($engDATE, $bangDATE, $date);
        return $convertedDATE;
    }
?>
@section('content')
    <section class="container">
        <button type="button" class="print"><i class="fa fa-print"></i>&nbsp; Print!</button>
        <div class="printx">
            <div style="width: 100%; text-align: center;"> 
                <img style="max-width: 100%;" src="{{ asset('upload/images/logo/'.config('siteSetting.logo'))}}" alt="logo">
            </div>
            @if($get_news->sub_1)<b>{{$get_news->sub_1}}</b>@endif
            <h2 style="font-weight: normal;line-height: 1.7em;text-align: center;text-align: -webkit-center;">{{$get_news->news_title}}</h2>
            @if($get_news->sub_2)<p>{{$get_news->sub_2}}</p>@endif
            <hr>
            <div class="news-time">      
             @if($get_news->userx)
                <p style="text-align: center;margin-bottom: 1em;text-align: -webkit-center;">{{$get_news->userx}}
                @else
                <p style="text-align: center;margin-bottom: 1em;text-align: -webkit-center;">{{$get_news->reporter->name}} &nbsp; {{$get_news->reporter->lname}}
                @endif
                প্রকাশিত:&nbsp; {{banglaDate(Carbon\Carbon::parse($get_news->publish_date)->format('d F, Y,  h:i A'))}}</p>
            </div>
            @if($get_news->thumb_url)
            <div style="width: 100%;"><img style="width: 100%;text-align: center;text-align: -webkit-center;z-index:1" src="{{$get_news->thumb_url}}" alt="{{$get_news->news_title}}" title="{{$get_news->news_title}}"></div>
            @else
            <div style="width: 100%;"><img style="width: 100%;text-align: center;text-align: -webkit-center;z-index:1" src="{{asset('upload/images/news/'.$get_news->image->source_path)}}" alt="{{$get_news->news_title}}" title="{{$get_news->news_title}}"></div>
            @endif
            @if($get_news->image)<span style="text-align: center;margin-bottom: 0.5em;text-align: -webkit-center;">{{$get_news->image->title}}</span>@endif
            
            <div style="text-align: justify; padding: 10px 0;line-height: 2em;font-size: 18px;">{!! $get_news->news_dsc !!}</div>
            
        </div>
    </section>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.3.3/jQuery.print.min.js"></script>
<script>
$('.print').on('click', function() {
  $.print(".printx");
});
</script>
@endsection