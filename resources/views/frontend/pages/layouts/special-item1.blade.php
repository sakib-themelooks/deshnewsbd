@php $sectionItems = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', '=', 'active')->orderBy('position', 'asc')->get(); @endphp
@if($sectionItems)

    @foreach($sectionItems as $sectionItem) 
    <img class="lazyload" src="{{asset('upload/images/homepage/'. $sectionItem->banner1)}}" />
                {{$sectionItem->item_title}}
    @endforeach
@endif

