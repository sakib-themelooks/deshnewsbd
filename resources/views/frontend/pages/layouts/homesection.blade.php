<?php
	// this function only ajax load
	if(isset($ajaxLoad)){
	    function banglaDate($date){
	        $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

	        $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০','জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );
	        $formatBng = Carbon\Carbon::parse($date)->format('j F, Y');
	        $convertedDATE = str_replace($engDATE, $bangDATE, $formatBng);
	        return $convertedDATE;
	    }
	}
?>
@php $lang = (request()->segment(1) == 'en' ? request()->segment(1) : 'bd'); 
$date = Carbon\Carbon::parse(now())->format('Y-m-d H:i:s'); @endphp

@if(count($sections) > 0)
@foreach($sections as $section)
   @if($section->image_position == 'desktop')
        @if((new \Jenssegers\Agent\Agent())->isDesktop())
        <section @if($section->layout_width == 'full') style="background:{{$section->background_color}} @if($section->background_image) url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed @endif ; background-size: cover;padding:{{$section->section_box_mobile}};margin:{{$section->section_box_desktop}};" @endif>
          @if($section->layout_width == 'box')
            <div class="container" style="background:{{$section->background_color}};border-radius:0; padding:{{$section->section_box_mobile}};margin:{{$section->section_box_desktop}};"> @endif
                <div class="row">  
            	@php try{ @endphp
            	@if($section->section_type != 'category')
            	    @if(View::exists('frontend.homepage.'.$section->section_type))
            		@include('frontend.homepage.'.$section->section_type)
            		@endif 
            	@else
            	
            	<?php  
                    $section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1)->with(['newsByCategory' => function ($query) {
                        $query->where('status', '=', 'active')->orderBy('id', 'desc'); }, 'newsByCategory.image', 'newsByCategory.getCategory:id,category_bd,category_en,slug', 'newsByCategory.subcategoryList:id,subcategory_bd,subcategory_en'])
                        ->orderBy('position', 'asc')->get();
                    ?>
                    @foreach($section_items as $section_item)
                        @if(View::exists('frontend.homepage.'.$section_item->section_layout))
                		@include('frontend.homepage.'.$section_item->section_layout)
                		@endif
                	@endforeach
            	@endif
            	@php }catch(\Exception $e){
            		echo '';
            	} 
            	@endphp
            </div>
                @if($section->layout_width == 'box')
            </div>@endif
        </section>
        @endif
    @elseif($section->image_position == 'mobile')
        @if((new \Jenssegers\Agent\Agent())->ismobile())
        <section @if($section->layout_width == 'full') style="background:{{$section->background_color}} @if($section->background_image) url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed @endif ; background-size: cover;padding:{{$section->section_box_mobile}};margin:{{$section->section_box_desktop}};" @endif>
          @if($section->layout_width == 'box')
            <div class="container" style="background:{{$section->background_color}};border-radius:0; padding:{{$section->section_box_mobile}};margin:{{$section->section_box_desktop}};"> @endif
                <div class="row">  
            	@php try{ @endphp
            	@if($section->section_type != 'category')
            	    @if(View::exists('frontend.homepage.'.$section->section_type))
            		@include('frontend.homepage.'.$section->section_type)
            		@endif 
            	@else
            	
            	<?php  
                    $section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1)->with(['newsByCategory' => function ($query) {
                        $query->where('status', '=', 'active')->orderBy('id', 'desc'); }, 'newsByCategory.image', 'newsByCategory.getCategory:id,category_bd,category_en,slug', 'newsByCategory.subcategoryList:id,subcategory_bd,subcategory_en'])
                        ->orderBy('position', 'asc')->get();
                    ?>
                    @foreach($section_items as $section_item)
                        @if(View::exists('frontend.homepage.'.$section_item->section_layout))
                		@include('frontend.homepage.'.$section_item->section_layout)
                		@endif
                	@endforeach
            	@endif
            	@php }catch(\Exception $e){
            		echo '';
            	} 
            	@endphp
            </div>
                @if($section->layout_width == 'box')
            </div>@endif
        </section>
        @endif
    @else
        <section @if($section->layout_width == 'full') style="background:{{$section->background_color}} @if($section->background_image) url({{asset('upload/images/homepage/'.$section->background_image)}}) no-repeat 50% 50% fixed @endif ; background-size: cover;padding:{{$section->section_box_mobile}};margin:{{$section->section_box_desktop}};" @endif>
          @if($section->layout_width == 'box')
            <div class="container" style="background:{{$section->background_color}};border-radius:0; padding:{{$section->section_box_mobile}};margin:{{$section->section_box_desktop}};"> @endif
                <div class="row">  
            	@php try{ @endphp
            	@if($section->section_type != 'category')
            	    @if(View::exists('frontend.homepage.'.$section->section_type))
            		@include('frontend.homepage.'.$section->section_type)
            		@endif 
            	@else
            	
            	<?php  
                    $section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1)->with(['newsByCategory' => function ($query) {
                        $query->where('status', '=', 'active')->orderBy('id', 'desc'); }, 'newsByCategory.image', 'newsByCategory.getCategory:id,category_bd,category_en,slug', 'newsByCategory.subcategoryList:id,subcategory_bd,subcategory_en'])
                        ->orderBy('position', 'asc')->get();
                    ?>
                    @foreach($section_items as $section_item)
                        @if(View::exists('frontend.homepage.'.$section_item->section_layout))
                		@include('frontend.homepage.'.$section_item->section_layout)
                		@endif
                	@endforeach
            	@endif
            	@php }catch(\Exception $e){
            		echo '';
            	} 
            	@endphp
            </div>
                @if($section->layout_width == 'box')
            </div>@endif
        </section>
    @endif
@endforeach 
@endif