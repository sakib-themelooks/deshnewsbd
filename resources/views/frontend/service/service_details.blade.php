@extends('frontend.layouts.master')
@section('title')
    @if($service_details){{$service_details->title}} | @endif  {{Config::get('siteSetting.title')}}
@endsection

@section('MetaTag')
    <meta name="keywords" content="{{ $service_details->meta_keywords }}" />
    <meta name="title" content="{{($service_details->meta_title) ? $service_details->meta_title : $service_details->title }}" />
    <meta name="description" content="{!! strip_tags( ($service_details->meta_description) ? $service_details->meta_description : Str::limit($service_details->description, 500)) !!}">
    <meta name="image" content="{{asset('upload/images/service/'.$service_details->image) }}">
    <meta name="rating" content="5">
    <!-- Schema.org for Google -->
    <meta itemprop="name" content="{{($service_details->meta_title) ? $service_details->meta_title : $service_details->title }}">
    <meta itemprop="description" content="{!! ($service_details->meta_description) ? strip_tags($service_details->meta_description) : Str::limit(strip_tags($service_details->description), 500) !!}">
    <meta itemprop="image" content="{{asset('upload/images/service/'.$service_details->image) }}">

@section('content')
    
    <div class="container" style="margin-top: 10px;">
        
        <div id="content">
            <div class="content-page">
            {!! $service_details->description !!}
           </div>
        </div>
        @foreach($sections as $section)
            @if(View::exists('frontend.service.'.$section->section_type))
            @include('frontend.service.'.$section->section_type, ['service_id' => $service_details->id]);
            @endif
        @endforeach 
    </div>
@endsection