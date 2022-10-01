@php
$header_dark_logo = DB::table('general_settings')->first()->dark_logo;
$header_logo = DB::table('general_settings')->first()->logo;
$footer_dark_logo = DB::table('general_settings')->first()->footer_dark_logo;
$footer_logo = DB::table('general_settings')->first()->footer_logo;
@endphp
@php
    function getArea($id=null,$is_for_upozilla = false){
        if($id == null){
            return \DB::table('deshjures')->where('cat_type','=','division')->select(['id','name_bd','name_en'])->get();
        }
        else{
            if(!$is_for_upozilla){
                return (int)$id;
                return \DB::table('deshjures')
                ->where('cat_type','=','district')
                ->where('parent_id','=',(int)$id)
                ->select(['id','name_bd','name_en'])->get();
            }
            else{
                return \DB::table('deshjures')->where('cat_type','=','upzilla')->where('parent_id','=',(int)$id)->select(['id','name_bd','name_en'])->get();
            }
        }
    }
    
    $divisions =getArea();
@endphp
<!doctype html>
<html lang="bn" class="no-js">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="icon" href="{{ asset('upload/images/logo/'. config('siteSetting.favicon'))}}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('upload/images/logo/'. config('siteSetting.favicon'))}}">
    <meta name="msapplication-TileImage" content="{{ asset('upload/images/logo/'. config('siteSetting.favicon'))}}" />
    <meta property="fb:pages" content="101610484897527" />
    <title>@yield('title')</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @yield('MetaTag')
    <!--rss -->
    <link rel="alternate" type="application/rss+xml" title="RSS" href="{{ route('feed') }}s.rss" />
    <script type="application/ld+json">
        {"@context": "https://schema.org","@type": "WebSite","url": "{{url('/')}}","potentialAction": {"@type": "SearchAction","target": "{{route('search_result')}}?q={search_term_string}","query-input": "required name=search_term_string"}}
    </script>
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/eitwork.css') }}">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{asset('frontend/css/custom.css') }}">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('css')
    {!! config('siteSetting.header') !!}
</head>


<body>
    @php $lang = (request()->segment(1) == 'en' ? request()->segment(1) : 'bd'); @endphp
    <!-- Container -->
    <div id="container">
        @includeFirst(['frontend.layouts.header'.config('siteSetting.header_no'), "frontend.layouts.header1"])
        @yield('content')
        @includeFirst(['frontend.layouts.footer'.config('siteSetting.footer_no'), "frontend.layouts.footer1"])
    </div>

    {!! config('siteSetting.google_adsense') !!}
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.imagesloaded.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/script.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/owl.carousel.js') }}"></script>
    {!! config('siteSetting.google_analytics') !!}
    <script type="text/javascript">
        function search_bar(e){""!=e?$.ajax({method:"get",url:'{{ route("search_news") }}',data:{q:e},datatype:"text",success:function(e){e?(document.getElementById("search_bar").style.display="block",document.getElementById("show_suggest_key").innerHTML=e):document.getElementById("show_suggest_key").innerHTML="<p>News not found.</p>"}}):document.getElementById("search_bar").style.display="none"}$(document).on("click",function(e){0===$(e.target).closest("#search_bar").length&&$("#search_bar").hide()}),$("#searchKey").on("click",function(){$("#search_bar").show()});
    </script>
    <script type="text/javascript">
        var mybutton=document.getElementById("myBtn");function scrollFunction(){document.body.scrollTop>20||document.documentElement.scrollTop>20?mybutton.style.display="block":mybutton.style.display="none"}function topFunction(){document.body.scrollTop=0,document.documentElement.scrollTop=0}window.onscroll=function(){scrollFunction()};
    </script>
    <script type="text/javascript">
        !function(e){var t=function(u,D,f){"use strict";var k,H;if(function(){var e;var t={lazyClass:"lazyload",loadedClass:"lazyloaded",loadingClass:"lazyloading",preloadClass:"lazypreload",errorClass:"lazyerror",autosizesClass:"lazyautosizes",fastLoadedClass:"ls-is-cached",iframeLoadMode:0,srcAttr:"data-src",srcsetAttr:"data-srcset",sizesAttr:"data-sizes",minSize:40,customMedia:{},init:true,expFactor:1.5,hFac:.8,loadMode:2,loadHidden:true,ricTimeout:0,throttleDelay:125};H=u.lazySizesConfig||u.lazysizesConfig||{};for(e in t){if(!(e in H)){H[e]=t[e]}}}(),!D||!D.getElementsByClassName){return{init:function(){},cfg:H,noSupport:true}}var O=D.documentElement,i=u.HTMLPictureElement,P="addEventListener",$="getAttribute",q=u[P].bind(u),I=u.setTimeout,U=u.requestAnimationFrame||I,o=u.requestIdleCallback,j=/^picture$/i,r=["load","error","lazyincluded","_lazyloaded"],a={},G=Array.prototype.forEach,J=function(e,t){if(!a[t]){a[t]=new RegExp("(\\s|^)"+t+"(\\s|$)")}return a[t].test(e[$]("class")||"")&&a[t]},K=function(e,t){if(!J(e,t)){e.setAttribute("class",(e[$]("class")||"").trim()+" "+t)}},Q=function(e,t){var a;if(a=J(e,t)){e.setAttribute("class",(e[$]("class")||"").replace(a," "))}},V=function(t,a,e){var i=e?P:"removeEventListener";if(e){V(t,a)}r.forEach(function(e){t[i](e,a)})},X=function(e,t,a,i,r){var n=D.createEvent("Event");if(!a){a={}}a.instance=k;n.initEvent(t,!i,!r);n.detail=a;e.dispatchEvent(n);return n},Y=function(e,t){var a;if(!i&&(a=u.picturefill||H.pf)){if(t&&t.src&&!e[$]("srcset")){e.setAttribute("srcset",t.src)}a({reevaluate:true,elements:[e]})}else if(t&&t.src){e.src=t.src}},Z=function(e,t){return(getComputedStyle(e,null)||{})[t]},s=function(e,t,a){a=a||e.offsetWidth;while(a<H.minSize&&t&&!e._lazysizesWidth){a=t.offsetWidth;t=t.parentNode}return a},ee=function(){var a,i;var t=[];var r=[];var n=t;var s=function(){var e=n;n=t.length?r:t;a=true;i=false;while(e.length){e.shift()()}a=false};var e=function(e,t){if(a&&!t){e.apply(this,arguments)}else{n.push(e);if(!i){i=true;(D.hidden?I:U)(s)}}};e._lsFlush=s;return e}(),te=function(a,e){return e?function(){ee(a)}:function(){var e=this;var t=arguments;ee(function(){a.apply(e,t)})}},ae=function(e){var a;var i=0;var r=H.throttleDelay;var n=H.ricTimeout;var t=function(){a=false;i=f.now();e()};var s=o&&n>49?function(){o(t,{timeout:n});if(n!==H.ricTimeout){n=H.ricTimeout}}:te(function(){I(t)},true);return function(e){var t;if(e=e===true){n=33}if(a){return}a=true;t=r-(f.now()-i);if(t<0){t=0}if(e||t<9){s()}else{I(s,t)}}},ie=function(e){var t,a;var i=99;var r=function(){t=null;e()};var n=function(){var e=f.now()-a;if(e<i){I(n,i-e)}else{(o||r)(r)}};return function(){a=f.now();if(!t){t=I(n,i)}}},e=function(){var v,m,c,h,e;var y,z,g,p,C,b,A;var n=/^img$/i;var d=/^iframe$/i;var E="onscroll"in u&&!/(gle|ing)bot/.test(navigator.userAgent);var _=0;var w=0;var M=0;var N=-1;var L=function(e){M--;if(!e||M<0||!e.target){M=0}};var x=function(e){if(A==null){A=Z(D.body,"visibility")=="hidden"}return A||!(Z(e.parentNode,"visibility")=="hidden"&&Z(e,"visibility")=="hidden")};var W=function(e,t){var a;var i=e;var r=x(e);g-=t;b+=t;p-=t;C+=t;while(r&&(i=i.offsetParent)&&i!=D.body&&i!=O){r=(Z(i,"opacity")||1)>0;if(r&&Z(i,"overflow")!="visible"){a=i.getBoundingClientRect();r=C>a.left&&p<a.right&&b>a.top-1&&g<a.bottom+1}}return r};var t=function(){var e,t,a,i,r,n,s,o,l,u,f,c;var d=k.elements;if((h=H.loadMode)&&M<8&&(e=d.length)){t=0;N++;for(;t<e;t++){if(!d[t]||d[t]._lazyRace){continue}if(!E||k.prematureUnveil&&k.prematureUnveil(d[t])){R(d[t]);continue}if(!(o=d[t][$]("data-expand"))||!(n=o*1)){n=w}if(!u){u=!H.expand||H.expand<1?O.clientHeight>500&&O.clientWidth>500?500:370:H.expand;k._defEx=u;f=u*H.expFactor;c=H.hFac;A=null;if(w<f&&M<1&&N>2&&h>2&&!D.hidden){w=f;N=0}else if(h>1&&N>1&&M<6){w=u}else{w=_}}if(l!==n){y=innerWidth+n*c;z=innerHeight+n;s=n*-1;l=n}a=d[t].getBoundingClientRect();if((b=a.bottom)>=s&&(g=a.top)<=z&&(C=a.right)>=s*c&&(p=a.left)<=y&&(b||C||p||g)&&(H.loadHidden||x(d[t]))&&(m&&M<3&&!o&&(h<3||N<4)||W(d[t],n))){R(d[t]);r=true;if(M>9){break}}else if(!r&&m&&!i&&M<4&&N<4&&h>2&&(v[0]||H.preloadAfterLoad)&&(v[0]||!o&&(b||C||p||g||d[t][$](H.sizesAttr)!="auto"))){i=v[0]||d[t]}}if(i&&!r){R(i)}}};var a=ae(t);var S=function(e){var t=e.target;if(t._lazyCache){delete t._lazyCache;return}L(e);K(t,H.loadedClass);Q(t,H.loadingClass);V(t,B);X(t,"lazyloaded")};var i=te(S);var B=function(e){i({target:e.target})};var T=function(e,t){var a=e.getAttribute("data-load-mode")||H.iframeLoadMode;if(a==0){e.contentWindow.location.replace(t)}else if(a==1){e.src=t}};var F=function(e){var t;var a=e[$](H.srcsetAttr);if(t=H.customMedia[e[$]("data-media")||e[$]("media")]){e.setAttribute("media",t)}if(a){e.setAttribute("srcset",a)}};var s=te(function(t,e,a,i,r){var n,s,o,l,u,f;if(!(u=X(t,"lazybeforeunveil",e)).defaultPrevented){if(i){if(a){K(t,H.autosizesClass)}else{t.setAttribute("sizes",i)}}s=t[$](H.srcsetAttr);n=t[$](H.srcAttr);if(r){o=t.parentNode;l=o&&j.test(o.nodeName||"")}f=e.firesLoad||"src"in t&&(s||n||l);u={target:t};K(t,H.loadingClass);if(f){clearTimeout(c);c=I(L,2500);V(t,B,true)}if(l){G.call(o.getElementsByTagName("source"),F)}if(s){t.setAttribute("srcset",s)}else if(n&&!l){if(d.test(t.nodeName)){T(t,n)}else{t.src=n}}if(r&&(s||l)){Y(t,{src:n})}}if(t._lazyRace){delete t._lazyRace}Q(t,H.lazyClass);ee(function(){var e=t.complete&&t.naturalWidth>1;if(!f||e){if(e){K(t,H.fastLoadedClass)}S(u);t._lazyCache=true;I(function(){if("_lazyCache"in t){delete t._lazyCache}},9)}if(t.loading=="lazy"){M--}},true)});var R=function(e){if(e._lazyRace){return}var t;var a=n.test(e.nodeName);var i=a&&(e[$](H.sizesAttr)||e[$]("sizes"));var r=i=="auto";if((r||!m)&&a&&(e[$]("src")||e.srcset)&&!e.complete&&!J(e,H.errorClass)&&J(e,H.lazyClass)){return}t=X(e,"lazyunveilread").detail;if(r){re.updateElem(e,true,e.offsetWidth)}e._lazyRace=true;M++;s(e,t,r,i,a)};var r=ie(function(){H.loadMode=3;a()});var o=function(){if(H.loadMode==3){H.loadMode=2}r()};var l=function(){if(m){return}if(f.now()-e<999){I(l,999);return}m=true;H.loadMode=3;a();q("scroll",o,true)};return{_:function(){e=f.now();k.elements=D.getElementsByClassName(H.lazyClass);v=D.getElementsByClassName(H.lazyClass+" "+H.preloadClass);q("scroll",a,true);q("resize",a,true);q("pageshow",function(e){if(e.persisted){var t=D.querySelectorAll("."+H.loadingClass);if(t.length&&t.forEach){U(function(){t.forEach(function(e){if(e.complete){R(e)}})})}}});if(u.MutationObserver){new MutationObserver(a).observe(O,{childList:true,subtree:true,attributes:true})}else{O[P]("DOMNodeInserted",a,true);O[P]("DOMAttrModified",a,true);setInterval(a,999)}q("hashchange",a,true);["focus","mouseover","click","load","transitionend","animationend"].forEach(function(e){D[P](e,a,true)});if(/d$|^c/.test(D.readyState)){l()}else{q("load",l);D[P]("DOMContentLoaded",a);I(l,2e4)}if(k.elements.length){t();ee._lsFlush()}else{a()}},checkElems:a,unveil:R,_aLSL:o}}(),re=function(){var a;var n=te(function(e,t,a,i){var r,n,s;e._lazysizesWidth=i;i+="px";e.setAttribute("sizes",i);if(j.test(t.nodeName||"")){r=t.getElementsByTagName("source");for(n=0,s=r.length;n<s;n++){r[n].setAttribute("sizes",i)}}if(!a.detail.dataAttr){Y(e,a.detail)}});var i=function(e,t,a){var i;var r=e.parentNode;if(r){a=s(e,r,a);i=X(e,"lazybeforesizes",{width:a,dataAttr:!!t});if(!i.defaultPrevented){a=i.detail.width;if(a&&a!==e._lazysizesWidth){n(e,r,i,a)}}}};var e=function(){var e;var t=a.length;if(t){e=0;for(;e<t;e++){i(a[e])}}};var t=ie(e);return{_:function(){a=D.getElementsByClassName(H.autosizesClass);q("resize",t)},checkElems:t,updateElem:i}}(),t=function(){if(!t.i&&D.getElementsByClassName){t.i=true;re._();e._()}};return I(function(){H.init&&t()}),k={cfg:H,autoSizer:re,loader:e,init:t,uP:Y,aC:K,rC:Q,hC:J,fire:X,gW:s,rAF:ee}}(e,e.document,Date);e.lazySizes=t,"object"==typeof module&&module.exports&&(module.exports=t)}("undefined"!=typeof window?window:{});
    </script>
    @yield('js')
    {{-- <script type="text/javascript">
        $(document).ready(function() {$(&#39;img#closed&#39;).click(function(){$(&#39;#bl_banner&#39;).hide(90);});});
    </script> --}}
    <script>
        const toggleSwitch=document.getElementById("checkbox"),currentTheme=localStorage.getItem("data-theme");function switchTheme(a){a.target.checked?(document.documentElement.setAttribute("data-theme","dark"),localStorage.setItem("data-theme","dark")):(document.documentElement.setAttribute("data-theme","light"),localStorage.setItem("data-theme","light"))}currentTheme&&(document.documentElement.setAttribute("data-theme",currentTheme),"dark"===currentTheme&&(toggleSwitch.checked=!0)),toggleSwitch.addEventListener("change",switchTheme,!1)
    </script>
    <script type="text/javascript">
        $(document).ready(function ($) {
    // Content slider
    $('.yt-content-slider').each(function () {
        var $slider = $(this),
            $panels = $slider.children('div'),
            data = $slider.data();
        // Remove unwanted br's
        //$slider.children(':not(.yt-content-slide)').remove();
        // Apply Owl Carousel
        
        $slider.owlCarousel2({
            responsiveClass: true,
            mouseDrag: true,
            video:true,
        lazyLoad: (data.lazyload == 'yes') ? true : false,
            autoplay: (data.autoplay == 'yes') ? true : false,
            autoHeight: (data.autoheight == 'yes') ? true : false,
            autoplayTimeout: data.delay * 1000,
            smartSpeed: data.speed * 1000,
            autoplayHoverPause: (data.hoverpause == 'yes') ? true : false,
            center: (data.center == 'yes') ? true : false,
            loop: (data.loop == 'yes') ? true : false,
      dots: (data.pagination == 'yes') ? true : false,
      nav: (data.arrows == 'yes') ? true : false,
            dotClass: "owl2-dot",
            dotsClass: "owl2-dots",
      margin: data.margin,
        navText:  ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
            
            responsive: {
                0: {
                    items: data.items_column4 
                    },
                480: {
                    items: data.items_column3
                    },
                768: {
                    items: data.items_column2
                    },
                992: { 
                    items: data.items_column1
                    },
                1200: {
                    items: data.items_column0 
                    }
            }
        });
        
    });
    });
    </script>
    <script type="text/javascript">
        $('.search-toggle').addClass('closed');
        
        $('.search-toggle .search-icon').click(function (e) {
          if ($('.search-toggle').hasClass('closed')) {
            $('.search-toggle').removeClass('closed').addClass('opened');
            $('.search-toggle, .search-container').addClass('opened');
            $('#search-terms').focus();
          } else {
            $('.search-toggle').removeClass('opened').addClass('closed');
            $('.search-toggle, .search-container').removeClass('opened');
          }
        });
    </script>
    <script src="https://translate.google.com/translate_a/element.js?cb=google_translate"></script>
    <script>
        function google_translate (){ 
        var opt = { 
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE, 
            pageLanguage: "bn" 
        }; 
        new google.translate.TranslateElement( opt, "translation" ); 
    } 
    
    addEventListener( "load", function(){ 
        if ( document.querySelector(".goog-te-menu-frame") ) { 
        
            document.getElementById( "translation" ).addEventListener( "click", function(){ 
                if ( this.id === "translation" ) scrollableLanguagesList(); 
            }); 
            addEventListener( "resize", function(){ 
                if ( "none" !== document.querySelector(".goog-te-menu-frame").style.display ) scrollableLanguagesList(); 
            }); 
        
        } 
    }); 
    
    function scrollableLanguagesList (){ 
        var 
         iframe = document.querySelector( ".goog-te-menu-frame" ), 
         doc = iframe.contentWindow.document, 
         div = doc.body.children[ 0 ], 
         table = div.children[ 0 ], 
         width = div.dataset.width || parseInt( div.style.width ), 
         rect, diff; 
        
        if ( ! div.dataset.width ) div.dataset.width = width; 
        
        if ( innerWidth < width ) { 
            rect = table.getBoundingClientRect(); 
            width = rect.right - rect.left; 
            diff = width - innerWidth; 
            
            div.style.width = ( width - diff - 24 ) + "px"; 
            div.style.padding = "4px 0 1em 4px"; 
            div.style.overflowX = "scroll"; 
        } 
        else { 
            div.style.width = "auto"; 
            div.style.padding = "4px"; 
            div.style.overflowX = "visible"; 
        } 
        
        rect = div.getBoundingClientRect(); 
        iframe.style.width = ( rect.right - rect.left ) + "px"; 
        iframe.style.height = ( rect.bottom - rect.top ) + "px"; 
    }
    document.body.removeAttribute("translate");
    </script>

    <script type="text/javascript">
        function changeLogo(event) {
            console.log($(event).is(':checked'));
            if($(event).is(':checked')){
                console.log($(event).val())
                console.log('{{$header_dark_logo}}')
                console.log('{{$footer_dark_logo}}')
                $('#logo').attr('src','{{ asset('upload/images/logo')}}/{{$header_dark_logo}}')
                $('#footer_logo').attr('src','{{ asset('upload/images/logo')}}/{{$footer_dark_logo}}')
            }
            else{
                $('#logo').attr('src','{{ asset('upload/images/logo')}}/{{$header_logo}}')
                $('#footer_logo').attr('src','{{ asset('upload/images/logo')}}/{{$footer_logo}}')
            }
        }
    </script>
    
    <script type="text/javascript">
        function getZilla(){
            let bivag = $('#bivag option:selected').val()
            var  url = '{{route("get_district", ":id")}}';
            url = url.replace(':id',bivag);
            
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    console.log("data")
                    if(data){
                        console.log(data)
                        $("#zilla_div").html(data);
                        document.getElementById('upozilla_div').innerHTML = "";
                    }else{
                        document.getElementById('zilla_div').innerHTML = "";
                        document.getElementById('upozilla_div').innerHTML = "";
                    }
                },
                error:function(e){
                    console.log(e);
                }
            });
        }
        
        function get_upzilla(id){
            var  url = '{{route("get_upzilla", ":id")}}';
            url = url.replace(':id',id);
            
            $.ajax({
                url:url,
                method:"get",
                success:function(data){
                    console.log("data")
                    if(data){
                        console.log(data)
                        $("#upozilla_div").html(data);
                    }else{
                        document.getElementById('upozilla_div').innerHTML = "";
                    }
                },
                error:function(e){
                    console.log(e);
                }
            });
        }
    </script>

</body>

</html>