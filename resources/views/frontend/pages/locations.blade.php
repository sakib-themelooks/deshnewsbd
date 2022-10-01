@extends('frontend.layouts.master')
@section('title')
   Division News |  {{Config::get('siteSetting.title')}}
@endsection

@section('content')
<style>
.form-control.btn.btn-success.btn-sm {
    background: #0066ff;
    width: 100%;
    color: white;
}
.mix77y {
    background: #fff;
    color: black;
    font-size: 18px !important;
    padding-left: 15px !important;
}
</style>
<?PHP
    $get_ads = App\Models\Addvertisement::where('page', 'archive')->where('status', 1)->get();
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
?>
<?PHP
function banglaDate($date){

    $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'second', 'hours from now',  'days', 'weeks',  'ago', 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

    $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০', 'সেকেন্ট', 'ঘন্টা পূর্বে', 'দিন', 'সপ্তাহ',  'পূর্বে', 'জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );

     $formatBng = Carbon\Carbon::parse($date)->format('j F, Y');
    $convertedDATE = str_replace( $engDATE, $bangDATE,  $formatBng);
    return $convertedDATE;
    }
?>

	<!-- block-wrapper-section
		================================================== -->
	<section class="block-wrapper">
		<div class="container section-body">
			<div class="row" >
				<div class="col-md-9 col-xs-12" id="sticky-conent">
				    <span style="font-size:35px;padding:0.8em 0;color:#0066ff;">Division News</span>
	                <div class="advertisement">
	                    <div class="desktop-advert">
	                       {!! $topOfNews !!}
	                    </div>
	           		</div>
	           		<!--<form action="{{route('location')}}" method="get" style="margin:15px 0">-->
	           		<!--<div class="row" style="background: #e7e7e7;padding: 10px 0;display: flex;align-items: center;">-->
	           		    
	           		<!--        <div class="col-xs-9 col-md-9">-->
	           		            
	           		<!--            <div class="form-group"  style="width:30% !important;float:left;margin-right:5px">-->
                               
              <!--                  <select name="division" onchange="get_district(this.value)" id="division" class="form-control select2 custom-select">-->
              <!--                  	<option value="">Select Division</option>-->
              <!--                      @foreach($divisions as $division)-->
              <!--                          <option @if(\Request::get('division') == $division->id) selected @endif value="{{$division->id}}" {{ (old('division') == $division->id) ? 'selected' : '' }}>{{$division->name_bd}}</option>-->
              <!--                      @endforeach-->
              <!--                  </select>-->
              <!--                  </div><div class="form-group" style="width:30% !important;float:left;margin-right:5px">-->
                               
              <!--                  <select name="zilla" onchange="get_upzilla(this.value)" id="getdistrict" class="form-control select2 custom-select">-->
              <!--                      <option value="">Select Zilla</option>-->
              <!--                      @foreach($zillas as $zilla)-->
              <!--                          <option @if(\Request::get('zilla') == $zilla->id) selected @endif value="{{$zilla->id}}" {{ (old('division') == $zilla->id) ? 'selected' : '' }}>{{$zilla->name_bd}}</option>-->
              <!--                      @endforeach-->
              <!--                  </select>-->
              <!--                  </div>-->
              <!--                  <div class="form-group" style="width:30% !important;float:left;margin-right:5px">-->
                               
              <!--                  <select name="upazilla" id="getupzilla" class="form-control select2 custom-select">-->
              <!--                     <option value="">Select Upazilla</option>-->
              <!--                     @foreach($upazillas as $upazilla)-->
              <!--                          <option @if(\Request::get('upazilla') == $upazilla->id) selected @endif value="{{$upazilla->id}}" {{ (old('upazilla') == $upazilla->id) ? 'selected' : '' }}>{{$upazilla->name_bd}}</option>-->
              <!--                      @endforeach-->
              <!--                  </select>-->
              <!--                  </div>-->
                            
	           		  
	           		<!--        </div>-->
	           		<!--        <div class="col-xs-3 col-md-3">-->
	           		<!--            <button class="form-control btn btn-success btn-sm">Find</button>-->
	           		<!--        </div>-->
	           		<!--</div>-->
	           		<!-- </form>-->
	                @if(count($get_news)>0)
    	                @foreach($get_news as $news)
    	                @if($news->getCategory && $news->getCategory->slug)
    						<a href="{{route('newsDetails', [$news->getCategory->slug, $news->id])}}" class="col-md-6 col-xs-12 mmb">
                                <div class="col-md-4 col-xs-4 img_90 pps videos">
                                    @if($news->news_type)
                                    <i class="fa {{$news->news_type}}" aria-hidden="true"></i>
                                    @endif
                                    @if($news->thumb_url)
                                        <img src="{{$news->thumb_url}}"  alt="{{$news->title}}">
                                    @elseif(Config::get('siteSetting.lazyload'))
                                        @if($news->image)
                                        <img class="lazyload" src="{{ asset('upload/images/default.jpg')}}" data-src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}"  alt="{{$news->news_title}}">
                                        @else
                                        <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                        @endif
                                    @elseif($news->image) 
                                    <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}" alt="{{($news->news_title)}}">
                                    @else
                                    <img src="{{ asset('upload/images/default.jpg')}}"  alt="">
                                    @endif
                                </div>
                                <div class="col-md-8 col-xs-8 mix77y">
                                    <h1 class="box_text_color-1">@if($news->sub_1)<span class="t-red">{{$news->sub_1}}</span>@endif{{$news->news_title}}</h1>
                                    <span style="color:#000;font-size: 14px;display: block;"><i class="fa fa-clock-o"></i>&nbsp; {{banglaDate($news->publish_date)}}</span>
                                </div>
                            </a>
                            @endif
                        @endforeach
                        
                        <div class="col-sm-12 pagination-box inline-block">
                             {{$get_news->appends(request()->query())->links()}}
                        </div>
	                @else
	                <h2>News not found!.</h2>
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


				<div class="col-md-3 col-xs-12 div_border">
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

@section('js')

<script>
    
    
    function get_district(id=null){
        var  url = '{{route("deshjure_district", ":id")}}';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#getdistrict").html(data);
                    $("#getupzilla").html('<option selected value="">Please Select Zilla</option>');
                }else{
                    $("#getdistrict").html('<option selected value="">Zilla not found</option>');
                    $("#getupzilla").html('<option selected value="">Please Select Zilla</option>');
                }
            }
        });
    }

    function get_upzilla(id=0){
        var  url = '{{route("deshjure_upzilla", ":id")}}';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#getupzilla").html(data);
                }else{
                    $("#getupzilla").html('<option selected value="">Upazilla not found</option>');
                }
            }
        });
    }

</script>
@endsection
