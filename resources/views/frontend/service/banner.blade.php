<?php
	$banner = App\Models\Banner::find($section->product_id); 
?>

@if($banner)
<section class="{{$section->device}}" style="@if($section->layout_width == 1) background:{{$section->background_color}}; @endif padding:{{$section->padding}};margin:{{$section->margin}};">
  <div class="container" @if($section->layout_width != 1) style="background:{{$section->background_color}};border-radius: 3px; padding: 0px;" @endif>
    
    @if($section->title)
    ser hera
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background:{{$section->text_bg}};display: {{$section->display}};margin: 0;padding: 15px 15px 0;"><h4 class="herakhans" style="color:{{$section->text_color}}">{{$section->title}}</h4></div>
    @endif
  	<div class="row">
    @for($i=1;$i<=$banner->banner_type; $i++)
    @php $col = round(12/$banner->banner_type); 
    $mobcol = ($banner->banner_type == 0) ? 12 : 6;
    $btn_link = 'btn_link'.$i;
    $btn_text = 'btn_text'.$i;
    $banner_img = 'banner'.$i;
    @endphp
	  <div class="{{$section->columns}}" style="margin:5px;padding: 5px;">
	     
	       <a title="{{$banner->title}}" href="{{url($banner->$btn_link)}}"><img src="{{asset('upload/images/banner/'.$banner->$banner_img)}}"><p style="text-align: center;color: #333;font-size: 14px;">{{($banner->$btn_text)}}</p></a>
	       
	  </div>
	  @endfor
	 </div>
	</div>
</section>
@endif
