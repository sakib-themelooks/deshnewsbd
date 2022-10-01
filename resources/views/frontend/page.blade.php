@extends('frontend.layouts.master')
@section('title')
    @if($find_page){{$find_page->page_name_bd}} | @endif  {{Config::get('siteSetting.title')}}
@endsection
@section('Metatag') @endsection
@section('content')
<section class="container">
	<div class="heraphp" style="background: white;padding: 1em;overflow: auto;display: block;line-height: 2.5em;font-size: 17px;">
	    @if($get_page)
	    <h1>@if($find_page){{$find_page->page_name_bd}} @endif</h1>
        
			{!! $get_page !!}
        @else
        <h2>Page not found!.</h2>
        @endif
    </div>
</section>
@endsection