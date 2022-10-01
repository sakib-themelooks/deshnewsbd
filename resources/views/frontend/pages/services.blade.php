@php $servicess = App\Models\Service::where('service_id', $section->product_id)->take($section->item_number)->get(); @endphp

<div class="row">
    <div class="col-md-12"><h3>{{$section->title}}</h3></div>
    @foreach($servicess as $service)
    <div class="col-md-3">
        <h4><a href="{{route('service_details', $service->slug)}}">{{$service->title}}</a></h4>
        <div>{!! Str::limit(strip_tags($service->description), 500) !!}</div>
    </div>
    @endforeach
</div>