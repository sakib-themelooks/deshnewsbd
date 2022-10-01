@extends('frontend.layouts.master')
@section('title') 404 No results found @endsection
@section('Metatag') @endsection
<meta http-equiv="refresh" content="5;url={{url('/')}}" />

@section('css')
<style type="text/css">
    .error-banner h1{font-size: 45px;}
.error-banners {
    display: flex;
    flex-direction: column;
    align-content: center;
    align-items: center;
}
.error-banners p {
    font-size: 30px;
    font-weight: bold;
    font-family: shurjo;
}
.error-banners h1 {
    font-size: 10em;
}
</style>
@endsection

@section('content')

<?PHP
$get_ads = App\Models\Addvertisement::where('page', 'reporter_page')->where('status', 1)->get();
$top_head_right = $topOfNews = $middleOfNews = $bottomOfNews = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
foreach ($get_ads as $ads){
    if($ads->position == 1){
        $top_head_right = $ads->add_code;
    }elseif($ads->position == 2){
        $bottomOfNews = $ads->add_code;
    }elseif($ads->position == 3){
        $sitebarTop = $ads->add_code;
    }elseif($ads->position ==4){
        $sitebarMiddle = $ads->add_code;
    }elseif($ads->position ==5){
        $sitebarBottom = $ads->add_code;
    }else{
        echo '';
    }
}
function banglaDate($date){

    $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'second', 'hours from now',  'days', 'weeks',  'ago', 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

    $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০', 'সেকেন্ট', 'ঘন্টা পূর্বে', 'দিন', 'সপ্তাহ',  'পূর্বে', 'জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );

    $formatBng = Carbon\Carbon::parse($date)->diffForHumans();
    $convertedDATE = str_replace($engDATE, $bangDATE, $formatBng);
    return $convertedDATE;
    }

?>

        <section class="block-wrapper">
            <div class="container section-body">
                <div class="row">
                    <div class="col-sm-12">

                        <!-- block content -->
                        <div class="block-content">

                            <!-- error box -->
                            <div class="error-box">
                                <div class="error-banners">
                                    @if(Session::get('locale'))
                                        {{Session::get('locale')}}
                                    @endif
                                    <h1>404</h1>
                                    <p>No results found</p>
                                </div>
                            </div>
                        </div>
                        <!-- End block content -->

                    </div>

                </div>

            </div>
        </section>
        <!-- End block-wrapper-section -->

@endsection
