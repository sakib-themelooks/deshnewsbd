<div class="hera">
@foreach($sections as $section)
<!--{{$section->section_type}}-->
    @if($section->layout_width != null)
    <div class="full" style="background:{{$section->background_color}};display: block;overflow: auto;">
    @endif
    <div class="container">
        @php $page = preg_replace("/\d/", "",$section->section_type).$section->box; 
        @endphp
        @if(View::exists('frontend.pages.'.$page))
        @include('frontend.pages.'.$page)
        @endif
    </div>
    @if($section->layout_width != null)</div>@endif
@endforeach
</div>