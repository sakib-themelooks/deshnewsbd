<?php  
    $section_items = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1)->with(['newsByCategory' => function ($query) {
        $query->where('status', '=', 'active')->orderBy('id', 'desc'); }, 'newsByCategory.image', 'newsByCategory.getCategory:id,category_bd,category_en,cat_slug_en', 'newsByCategory.subcategoryList:id,subcategory_bd,subcategory_en'])
        ->orderBy('position', 'asc')->get();
    ?>
    @foreach($section_items as $section_item)
        @if(View::exists('frontend.pages.layouts.'.$section_item->section_layout))
        @include('frontend.pages.layouts.'.$section_item->section_layout)
        @endif
    @endforeach
