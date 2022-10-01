<div class="{{$section_item->colmd}} col-xs-12" style="margin:{{$section_item->margin}};padding:{{$section_item->padding}};">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <div class="row mix1">
        <div class="map mmb">@include('frontend.map')</div>
        @include('frontend.layouts.deshjure')
        {!! $section_item->codex !!}
    </div>
</div>