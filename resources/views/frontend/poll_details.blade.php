@extends('frontend.layouts.master')
@section('title')
    {{$poll->question_title .' | Poll' }}
@endsection
   @section('MetaTag')
       
        <!-- Schema.org for Google -->
        <meta itemprop="name" content="{{$poll->question_title .' | Poll' }} | {{Config::get('siteSetting.site_name')}}">
        <meta itemprop="description" content="{{Str::limit(strip_tags($poll->poll_details), 200)}}">
        <meta itemprop="image" content="@if($poll->image){{asset('upload/images/poll/'.$poll->image) }}@endif">

        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="{{url('/')}}">
        <meta name="twitter:creator" content="@neyamul">
        <meta name="twitter:title" content="{{$poll->question_title}}">
        <meta name="twitter:description" content="{{Str::limit($poll->poll_details, 200)}}">
        <meta name="twitter:image" content="@if($poll->image){{asset('upload/images/poll/'.$poll->image) }}@endif">
         <!-- Twitter - Product (e-commerce) -->


        <!-- Open Graph general (Facebook, Pinterest & Google+) -->
        <meta property="og:title" content="{{$poll->question_title}} |  {{Config::get('siteSetting.site_name')}}">
        <meta property="og:description" content="{{Str::limit(strip_tags($poll->poll_details), 100)}}">
        <meta property="og:image" content="@if($poll->image){{asset('upload/images/poll/'.$poll->image) }}@endif" />
        <meta property="og:url" content="{{ url()->full() }}">

        <meta property="og:site_name" content="{{config('siteSetting.site_name')}}">
        <meta property="og:locale" content="bn_BD">
       
        <meta property="og:type" content="article">
        <link rel="image_src" href="@if($poll->image){{asset('upload/images/poll/'.$poll->image) }}@endif">
        <link rel="preload" as="image" href="@if($poll->image){{asset('upload/images/poll/'.$poll->image) }}@endif">
        <media:thumbnail url="@if($poll->image){{asset('upload/images/poll/'.$poll->image) }}@endif"/>

    @endsection
@section('content')
<?PHP
    $get_ads = App\Models\Addvertisement::where('page', 'poll')->where('status', 1)->get();
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
                <div class="category-title">
                    <div class="row">
                    <div class="col-sm-3">
                        <div class="category-title">
                           <span class="breaking-news" id="head-title">
                            
                                <a href="{{ route('pollings') }}">
                                Poll</a>
                            
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6 ">
                        <div class="single-post-box" style="text-align: right;">
                            <div class="share-post-box">
                                <ul class="share-box">
                                    <li><i class="fa fa-share-alt"></i></li>
                                    <li><a class="facebook"  href="http://www.facebook.com/sharer.php?u={{ route('poll_details', $poll->slug) }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="twitter" href="https://twitter.com/share?url={{ route('poll_details', $poll->slug) }}&amp;text={!! $poll->question_title !!}&amp;hashtags=Bdtype" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="google" href="https://reddit.com/submit?url={{ route('poll_details', $poll->slug) }}&amp;title={!! $poll->question_title !!}" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a class="whatsapp" href="https://reddit.com/submit?url={{ route('poll_details', $poll->slug) }}&amp;title={!! $poll->question_title !!}" target="_blank"><i class="fa fa-reddit"></i></a></li>
                                    <li><a class="linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{ route('poll_details', $poll->slug) }}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a class="pinterest"  href="http://pinterest.com/pin/create/button/?url={{ route('poll_details', $poll->slug) }}" target="_blank"><i class="fa fa-pinterest"></i></a></li>
                                    <li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#" class="dribble"><i class="fa fa-dribbble"></i></a></li>
                                    <li><a href="https://bdtype.com/feed" class="rss"><i class="fa fa-rss"></i></a></li>
                                        <!-- <li><a class="whatsapp"  href="https://web.whatsapp.com/send?text={{ route('poll_details', $poll->slug) }}" target="_blank"><i class="fa fa-whatsapp"></i></a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 rightheader" >
                       <div class="rightAds" style="max-height: 45px !important;">
                            {!! $top_head_right !!}
                        </div>
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
					
	                <div class="title-post">
                        <h3>{{$poll->question_title}}</h3>
                    </div>
                    <i class="fa fa-calendar" aria-hidden="true"></i> {{banglaDate($poll->start_date)}} <i class="fa fa-clock-o">
                                        </i> {{Carbon\Carbon::parse($poll->start_date)->diffForHumans()}}
                    <hr>
	                <div class="advertisement">
	                    <div class="desktop-advert">
	                       {!! $topOfNews !!}
	                    </div>
	           		</div>
	                @if($poll)
	               
	                	 <div class="post-content news_dsc" id="divContent">
	                	 	{!! $poll->poll_details !!}
	                	 </div>
	                	<div class="row">
	                	<div class="col-md-3"></div>
	                	<div class="col-md-6">
                        <div style="background: {!! $poll->bg_color !!}; color: {!! $poll->text_color !!}; margin:10px 5px; padding: 3px 10px;">
                            <form action="{{url('/')}}" method="get" id="polling">
                                <input type="hidden" name="poll_id" value="{{$poll->id}}">
                               <h2 style="margin-top: 0; font-size: 15px;line-height: initial;">{{$poll->question_title}}</h2>
                              
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
                                    <p><button class="btn btn-success">VOTE</button></p>
                                @endif
                            </form>
                        </div>
                        </div>
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

@section('js')
<script type="text/javascript">
	    $('#polling').on('submit',function(e){
     e.preventDefault();
     $.ajax({
            type:'get',
            url: '{{ route("userPolling") }}',
            data: $('#polling').serialize(),
            success: function (data) {
                if(data.status){
                    toastr.success(data.msg);
                    $("[name=pollOption]").removeAttr("checked");
                }else{
                    toastr.error(data.msg);
                }
            }
        })
    });
</script>
@endsection

