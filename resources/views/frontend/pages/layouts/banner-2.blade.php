<?php
	$banner = App\Models\Banner::find(4); 
?>

@if($banner)
<div class="{{($section_item->colmd)}}">
  	<div class="category-slider-inner products-list yt-content-slider releate-products grid" data-rtl="yes" data-autoplay="yes" data-pagination="no" data-delay="5" data-speed="1" data-margin="5" data-items_column0="{{$section_item->colxs}}" data-items_column1="{{$section_item->colxs}}" data-items_column2="{{$section_item->colxs}}" data-items_column3="3" data-items_column4="2" data-arrows="yes" data-lazyload="yes" data-loop="yes" data-hoverpause="yes">
    @for($i=1;$i<=$banner->banner_type; $i++)
    @php $col = round(12/$banner->banner_type); 
    $mobcol = ($banner->banner_type == 0) ? 12 : 6;
    $btn_link = 'btn_link'.$i;
    $btn_text = 'btn_text'.$i;
    $banner_img = 'banner'.$i;
    @endphp
    <a title="{{$banner->title}}" href="{{url($banner->$btn_link)}}">
        <img src="{{asset('upload/images/banner/'.$banner->$banner_img)}}">
        <p style="text-align: center;color: #333;font-size: 14px;">{{($banner->$btn_text)}}</p>
    </a>
    @endfor
    </div>
</div>
@endif
