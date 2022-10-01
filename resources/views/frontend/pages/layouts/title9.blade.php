@if($section_item->item_title)
<a style="background:{{$section_item->background_color}};margin-bottom: 0;" class="news-title t9" href="#">
    <h1 style="color:{{$section_item->text_color}};font-size: 25px;padding:0 10px;font-weight: bold;">{!! $section_item->icon !!} {{$section_item->item_title}}</h1>
</a>
@endif
<style>
.t9 h1:before {
    content: "";
    width: 20px;
    height: 20px;
    background: #0573e6;
    display: inline-block;
    border-radius: 50%;
    position: relative;
    top: 4px;
    margin-right: 10px;
}
</style>