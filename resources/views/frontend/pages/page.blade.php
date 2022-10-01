@extends('frontend.layouts.master')
@section('title', $page->page_name_bd . ' | '. Config::get('siteSetting.site_name') )

@section('metatag')
    <title>@if($page->meta_title){{$page->meta_title}}@else{{$page->page_name_bd}} | {{Config::get('siteSetting.site_name')}}@endif</title>
    <meta name="title" content="@if($page->meta_title){{$page->meta_title}}@else{{$page->page_name_bd}} | {{Config::get('siteSetting.site_name')}}@endif">
    <meta name="description" content="{{$page->meta_description}}">
    <meta name="keywords" content="{{$page->meta_keywords}}" />
    
    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta property="og:description" content="@if($page->meta_title){{$page->meta_title}}@else{{$page->page_name_bd}} | {{Config::get('siteSetting.site_name')}}@endif">
    <meta property="og:description" content="{{$page->meta_title}}">
    <meta property="og:image" content="{{asset('upload/pages/'.$page->meta_image)}}">
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:site_name" content="{{Config::get('siteSetting.site_name')}}">
    <meta property="og:locale" content="en">
    <meta property="og:type" content="website">
    <meta property="fb:admins" content="1323213265465">
    <meta property="fb:app_id" content="13212465454">
    <meta property="og:type" content="e-commerce">

    <!-- Schema.org for Google -->

    <meta itemprop="title" content="@if($page->meta_title){{$page->meta_title}}@else{{$page->page_name_bd}} | {{Config::get('siteSetting.site_name')}}@endif">
    <meta itemprop="description" content="{{$page->meta_title}}">
    <meta itemprop="image" content="{{asset('upload/pages/'.$page->meta_image)}}">

    <!-- Twitter -->
    <meta name="twitter:card" content="{{$page->meta_title}}">
    <meta name="twitter:title" content="@if($page->meta_title){{$page->meta_title}}@else{{$page->page_name_bd}} | {{Config::get('siteSetting.site_name')}}@endif">
    <meta name="twitter:description" content="{{$page->meta_title}}">
    <meta name="twitter:site" content="{{url('/')}}">
    <meta name="twitter:creator" content="@Neyamul">
    <meta name="twitter:image:src" content="{{asset('upload/pages/'.$page->meta_image)}}">
@endsection

@section('content')
    <div class="container" style="margin-top: 10px;">
        <h1>@if($page){{$page->page_name_bd}} @endif</h1>
        <div id="content" class="col-sm-12">
            <div class="content-page">
            {!! $page->page_dsc !!}
           </div>
        </div>
    </div>   
    @foreach($sections as $section)
        @php $page = preg_replace("/\d/", "",$section->section_type).$section->box; @endphp
        @if(View::exists('frontend.pages.'.$page))
        @include('frontend.pages.'.$page)
        @endif  
    @endforeach
@endsection

