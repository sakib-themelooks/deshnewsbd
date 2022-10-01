@extends('frontend.layouts.master')
@section('title')
    @if($page){{$page->page_name_bd}} | @endif  {{Config::get('siteSetting.title')}}
@endsection
@section('Metatag')
@endsection
@section('content')
<style>
.converter {
    margin: auto;
}
.convert_button_left {
    text-align: center;
}
.unicode_textarea {
    width: 100%;
    height: 220px;
    font-family: solaimanLipi;
    font-size: 18px;
    color: #000;
    border: 1px solid #999;
    outline: none;
    border-radius: 5px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    padding: 5px;
    margin-top: 3em;
}
.fa-refresh:before,
.fa-arrow-up:before,
.fa-arrow-down:before {
    margin-right: 11px;
}
textarea {
    overflow: auto;
    background-color: floralwhite !important;
}
.bijoy_textarea {
    width: 100%;
    height: 220px;
    font-family: SutonnyMJ;
    font-size: 18px;
    color: #000;
    border: 1px solid #999;
    outline: none;
    border-radius: 5px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    padding: 5px;
    margin-bottom: 3em;
}
.bijoy_button {
    font-family: SolaimanLipi;
    margin-right: 10px;
}
.btn-primary {
    color: #fff;
    background-color: #286090;
    border-color: #204d74;
}
.btn-success {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
}
.btn-danger {
    color: #fff;
    background-color: #d9534f;
    border-color: #d43f3a;
}
</style>
<section class="block-wrapper">
    <div class="converter container">
            <form name="myForm" action="#" method="post">
                <div class="col-md-12 col-xs-12">
                    <TEXTAREA class="unicode_textarea" onKeyPress="return KeyBoardPress(event);" id=EDT onKeyDown="return KeyBoardDown(event);" name="textarea" onBlur="InputLengthCheck();" onKeyUp="InputLengthCheck();" autofocus="autofocus" value="" placeholder="ইউনিকোড কি-বোর্ডের লেখা এখানে পেস্ট করুন"></TEXTAREA>
                </div>
                <div class="col-md-12 col-xs-12 convert_button_left m-b-1 m-t-1">
                    <button type="button" class="bijoy_button btn btn-primary" onClick="ConvertToTextArea('CONVERTEDT');" name="ConvertToAsciiButton"><span class="fa fa-arrow-down" aria-hidden="true"></span> ইউনিকোড টু বিজয়</button>
                    <button type="button" class="unicode_button btn btn-success" onClick="ConvertFromTextArea('CONVERTEDT');" name="ConvertButton"><span class="fa fa-arrow-up" aria-hidden="true"></span> বিজয় টু ইউনিকোড</button>
                    <button type="reset" class="reset_button btn btn-danger m-1 m-sm-1 m-md-0" name=ClearButton><span class="fa fa-refresh" aria-hidden="true"></span> মুছে ফেলুন </button>
                </div>
                <div class="col-md-12 col-xs-12">
                    <input readonly type="hidden" name="CharsTyped" size="2" style="font-weight:bold; border: 0px solid #2D69AE; color:#808080; text-align:left;">
                    <input readonly type="hidden" name="WordsTyped" size="3" style="font-weight:bold; border: 1px solid #2D69AE; color:#808080; text-align:right;">
                    <input readonly type="hidden" name="CharsLeft" size="8">
                    <input readonly type="hidden" name="WordsLeft" size="8">
                </div>
                <div class="col-md-12 col-xs-12">
                    <TEXTAREA class="bijoy_textarea" id="CONVERTEDT" autofocus value="" placeholder="বিজয় কি-বোর্ডের লেখা এখানে পেস্ট করুন"></TEXTAREA>
                </div>
            </form>
    </div>
</section>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('frontend/converter/bijoy2uni.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/converter/common.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/converter/count.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/converter/js.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/converter/js1.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/converter/layout.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/converter/uni2bijoy.js') }}"></script>
@endsection