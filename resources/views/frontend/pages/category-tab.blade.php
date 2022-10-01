<?php  
    $section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1)->orderBy('position', 'asc')->get();

    ?>
    @foreach($section_items as $section_item)
        @if(View::exists('frontend.pages.tab-layouts.'.$section_item->section_layout))
        
        <?php  
            $category = json_decode($section_item->item_id);
          
            $get_news = App\Models\News::where('status', 'active')->whereJsonContains('categories', $category[0])->orderBy('id', 'desc')->take($section_item->item_number)->get();

        ?>
        <div class="{{$section_item->colmd}} col-xs-12 p-0">
            <div class="col-md-12 col-xs-12 ">
                @include(('frontend.pages.layouts.title').$section_item->item_title_number)
                @include('frontend.pages.tab-layouts.tabs')
            </div>
            <div id="post_data{{$section_item->id}}" class="col-md-12 col-xs-12">
                @include('frontend.pages.tab-layouts.'.$section_item->section_layout)
            </div>
        </div>
		@endif
	@endforeach