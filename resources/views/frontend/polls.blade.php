@extends('frontend.layouts.master')
@section('title')
    Polls | {{Config::get('siteSetting.title')}}
@endsection
@section('Metatag') @endsection
@section('content')
<?PHP
    $get_ads = App\Models\Addvertisement::where('page', 'custom_page')->where('status', 1)->get();
    $top_head_right = $topOfNews = $middleOfNews = $bottomOfNews = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
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

    $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'second', 'hours from now',  'days', 'weeks',  'ago', 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

    $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০', 'সেকেন্ট', 'ঘন্টা পূর্বে', 'দিন', 'সপ্তাহ',  'পূর্বে', 'জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );

     $formatBng = Carbon\Carbon::parse($date)->format('j F, Y');
    $convertedDATE = str_replace($engDATE, $bangDATE, $formatBng);
    return $convertedDATE;
    }

?>
	<section class="ticker-news category">
		<div class="container">
			<div class="row">
				<div class="col-sm-8" >
					<div class="category-title">
						<span class="breaking-news" id="head-title">Online Poll</span>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="rightAds">
	                    {!! $top_head_right !!}
	                </div>
				</div>
			</div>
		</div>
	</section>
	<!-- block-wrapper-section
		================================================== -->
	<section class="block-wrapper">
		<div class="container section-body">
			<div class="row">
				<div class="col-sm-9" id="sticky-conent">
					
	                <div class="advertisement">
	                    <div class="desktop-advert">
	                       {!! $topOfNews !!}
	                    </div>
	           		</div>
	                @if(count($polls)>0)
	               
	                <div class="row">
	                	@foreach($polls as $poll)
	                	<div class="col-md-6">
						<div style="background: {!! $poll->bg_color !!}; color: {!! $poll->text_color !!}; margin:10px 5px; padding: 3px 10px;">
                            <h2 style="margin-top: 0; font-size: 15px;line-height: initial;"><a style="color: {!! $poll->text_color !!};" href="{{route('poll_details', $poll->slug)}}"> {{$poll->question_title}} </a></h2>
                              
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
                            @endif
                        </div>
                        </div>
                        @endforeach
                    </div>
                   
	                @else
	                <h2>Poll not found!.</h2>
	                @endif
	                <div class="row" id="sticky-conent">
	                    <div class="col-md-12 col-sm-12">
	                        <div class="advertisement">
	                            <div class="desktop-advert">
	                                {!! $bottomOfNews !!}
	                            </div>
	                           
	                        </div>
	                    </div>
	                </div>
				</div>


				<div class="col-sm-3 div_border">
					<div class="sidebar large-sidebar">
						<div class="widget features-slide-widget">
	                        <div class="advertisement">
	                            <div class="desktop-advert">
	                                {!! $sitebarTop !!}
	                            </div>
	                        </div>
	                    </div>
						<!-- sidebar -->
						@include('frontend.layouts.sitebar')
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

