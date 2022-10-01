<?php
	$banner = App\Models\Banner::find($section->product_id); 
?>

@if($banner)
<div class="row">
    @for($i=1;$i<=$banner->banner_type; $i++)
    @php $col = round(12/$banner->banner_type); 
    $mobcol = ($banner->banner_type == 0) ? 12 : 6;
    $btn_link = 'btn_link'.$i;
    $btn_text = 'btn_text'.$i;
    $banner_img = 'banner'.$i;
    @endphp
	  <div class="{{$section->columns}}">
	    <a href="{{url($banner->$btn_link)}}"><img alt="{{$banner->title}}" width="1200" height="110" src="{{asset('upload/images/banner/'.$banner->$banner_img)}}"><p style="text-align: center;color: #333;font-size: 14px;">{{$banner->$btn_text}}</p></a>
	  </div>
	  @endfor
</div>
@endif
