@php $sectionItems = App\Models\HomepageSectionItem::where('section_id', $section->id)->where('status', 1)->orderBy('position', 'asc')->get(); @endphp
<style>
.item-link24 {
    display: flex;
    flex-direction: row;
    justify-content: center;
}
.item-link23 {
    padding-right: 0!important;
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.link-image {
    position: relative;
    margin: 3px;
    text-align: center;
}
.item-link23 .link-image::after {
    position: absolute;
    content: "";
    background: rgba(0,0,0,.03);
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    border-radius: 4px;
}
.item-titless {margin-bottom: 5px;}
@media screen and (max-width: 1300px) {.item-link24 .item-link23:last-child {display: none;}}
</style>
@if($sectionItems)
<section style="@if($section->layout_width == 1) background:{{$section->background_color}}; @endif padding:{{$section->padding}};margin:{{$section->margin}};">
  <div class="container" @if($section->layout_width != 1) style="border-radius: 3px; padding: 0px;" @endif>
  
    @foreach($sectionItems as $sectionItem) 
    <div class="col-md-4 col-xs-12" style="padding: 0 3px;">
        <div class="double-item" style="background:{{$section->background_color}};">
            <div class="item-titless">
                <img height="16" width="16" class="lazyload" src="{{asset('upload/images/homepage/'. $sectionItem->banner9)}}" />
                <b>{{$sectionItem->item_title}}</b>
            </div>
             
            <div class="item-link24">
                <a class="item-link23" href="{{$sectionItem->link1}}">
                    <img class="link-image" width="100" src="{{asset('upload/images/homepage/'. $sectionItem->banner1)}}" />
                    <div class="link-text">{{ $sectionItem->name1 }}</div>
                    <div class="link-img">{{ $sectionItem->subname1 }}</div>
                </a>
        
                <a class="item-link23" href="{{ $sectionItem->link2 }}">
                    <img class="link-image" width="100" src="{{asset('upload/images/homepage/'. $sectionItem->banner2)}}" />
                    <div class="link-text">{{ $sectionItem->name2 }}</div>
                    <div class="link-img">{{ $sectionItem->subname2 }}</div>
                </a>
                <a class="item-link23" href="{{ $sectionItem->link3 }}">
                    <img class="link-image" width="100" src="{{asset('upload/images/homepage/'. $sectionItem->banner3)}}" />
                    <div class="link-text">{{ $sectionItem->name3 }}</div>
                    <div class="link-img">{{ $sectionItem->subname3 }}</div>
                </a>
            </div>
            
        </div>
    </div>
    @endforeach
    </div>
</section>
@endif

