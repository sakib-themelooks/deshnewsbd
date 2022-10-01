@extends('frontend.layouts.master')
@section('title')
    ({{$comments->count()}}) মন্তব্যসমূহ - {{$get_news->news_title}} | বিডি টাইপ
@endsection
@section('MetaTag')
    <meta name="keywords" content="{{ $get_news->keywords }}" />
    <!-- Schema.org for Google -->
    <meta itemprop="name" content="{{$get_news->news_title}}">
    <meta itemprop="description" content="{{Str::limit(strip_tags($get_news->news_dsc), 200)}}">
    <meta itemprop="image" content="{{asset('upload/images/'.$get_news->image->source_path)}}">

        <!-- Twitter -->
    <meta name="twitter:card" content="{{Str::limit(strip_tags($get_news->news_dsc), 150)}}">
    <meta name="twitter:title" content="{{$get_news->news_title}}">
    <meta name="twitter:description" content="{{Str::limit($get_news->news_dsc, 200)}}">
    <meta name="twitter:site" content="{{url('/')}}">
    <meta name="twitter:image:src" content="{{asset('upload/images/'.$get_news->image->source_path)}}">
    <meta name="twitter:player" content="#">
    <!-- Twitter  -->

    <!-- Open Graph general (Facebook, Pinterest & Google+) -->
    <meta name="og:title" content="{{$get_news->news_title}}">
    <meta name="og:description" content="{{Str::limit(strip_tags($get_news->news_dsc), 100)}}">
    <meta name="og:image" content="{{asset('upload/images/'.$get_news->image->source_path)}}">
     <meta name="og:url" content="{{ url()->full() }}">
    <meta name="og:site_name" content="{{config('siteSetting.site_name')}}">
    <meta name="og:locale" content="bn_BD">
    <meta name="og:video" content="@if($get_news->type == 3 && count($get_news->attachFiles)>0) {{asset('upload/file/'.$get_news->attachFiles[0]->source_path)}}@endif">
    <meta name="fb:admins" content="1323213265465">
    <meta name="fb:app_id" content="13212465454">
    <meta name="og:type" content="product">
    <meta name="robots" content="index,follow" />
@endsection

@section('css')

<style type="text/css">
	.single-post-box .post-gallery img {
	  /*  width: initial !important; */
	}
	.single-post-box > .post-content{
		line-height: 28px;
	}
    .reply-box{
        width:100%;resize: vertical;
    }
    .comment-content a{cursor: pointer;font-size: 12px;}


</style>

@endsection
<?PHP
$get_ads = App\Models\Addvertisement::where('page', 'details_page')->where('status', 1)->get();
$top_head_right = $topOfNews = $middleOfNews = $bottomOfNews = $sitebarTop = $sitebarMiddle = $sitebarBottom = null ;
foreach ($get_ads as $ads){
    if($ads->position == 2){
        $top_head_right = $ads->add_code;
    }elseif($ads->position == 3){
        $topOfNews = $ads->add_code;
    }elseif($ads->position == 4){
        $middleOfNews = $ads->add_code;
    }elseif($ads->position == 5){
        $bottomOfNews = $ads->add_code;
    }elseif($ads->position == 6){
        $sitebarTop = $ads->add_code;
    }elseif($ads->position == 7){
        $sitebarMiddle = $ads->add_code;
    }elseif($ads->position == 8){
        $sitebarBottom = $ads->add_code;
    }else{
        echo '';
    }
}

function banglaDate($date){
    $engDATE = array(1,2,3,4,5,6,7,8,9,0, 'second', 'hours from now',  'days', 'weeks',  'ago', 'January', 'February', 'March','April', 'May', 'June', 'July', 'August','September', 'October', 'November', 'December', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');

    $bangDATE = array('১','২','৩','৪','৫','৬','৭','৮','৯','০', 'সেকেন্ট', 'ঘন্টা পূর্বে', 'দিন', 'সপ্তাহ',  'পূর্বে', 'জানুয়ারী','ফেব্রুয়ারী','মার্চ','এপ্রিল','মে','জুন','জুলাই','আগস্ট','সেপ্টেম্বর','অক্টোবর','নভেম্বর','ডিসেম্বর','শনিবার','রবিবার','সোমবার','মঙ্গলবার',' বুধবার','বৃহস্পতিবার','শুক্রবার' );

    $formatBng = Carbon\Carbon::parse($date)->format('j F, Y');
    $convertedDATE = str_replace($engDATE, $bangDATE, $formatBng);
    return $convertedDATE;
    }
?>

@section('content')
    <section class="ticker-news category">
        <div class="container">
            <div class="category-title">
                <div class="row">
                <div class="col-sm-3 col-xs-12">
                    <div class="category-title">
                       <span class="breaking-news" id="head-title">
                            মন্তব্যসমূহ ({{ str_replace([1,2,3,4,5,6,7,8,9,0], ['১','২','৩','৪','৫','৬','৭','৮','৯','০'], $comments->count() )}})
                       	</span>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12">
                	<div class="single-post-box" style="text-align: right;">
            			<div class="share-post-box">
							<ul class="share-box">
								<li><i class="fa fa-share-alt"></i></li>
								<li><a class="facebook"  href="http://www.facebook.com/sharer.php?u={{ route('news_details', $get_news->news_slug) }}" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="twitter" href="https://twitter.com/share?url={{ route('news_details', $get_news->news_slug) }}&amp;text={!! $get_news->news_title !!}&amp;hashtags=Bdtype" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="google" href="http://reddit.com/submit?url={{ route('news_details', $get_news->news_slug) }}&amp;title={!! $get_news->news_title !!}" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="whatsapp" href="http://reddit.com/submit?url={{ route('news_details', $get_news->news_slug) }}&amp;title={!! $get_news->news_title !!}" target="_blank"><i class="fa fa-reddit"></i></a></li>
                                <li><a class="linkedin"  href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ route('news_details', $get_news->news_slug) }}" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#" class="dribble"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#" class="rss"><i class="fa fa-rss"></i></a></li>
									<!-- <li><a class="whatsapp"  href="https://web.whatsapp.com/send?text={{ route('news_details', $get_news->news_slug) }}" target="_blank"><i class="fa fa-whatsapp"></i></a></li> -->
							</ul>
						</div>
					</div>
                </div>
                <div class="col-sm-3 col-xs-12">
                   <div class="rightAds">
                        {!! $top_head_right !!}
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
	<!-- block-wrapper-section
		================================================== -->
	<section class="block-wrapper">
		<div class="container section-body" >
			<div class="row">
				<div class="col-sm-9 divrigth_border" id="sticky-conent">
                    
					<!-- block content -->
					<div class="block-content">
						<!-- single-post box -->
						<div class="single-post-box">

							<div class="title-post">

								<h1><a href="{{route('news_details', $get_news->news_slug)}}" >{{$get_news->news_title}}</a></h1>
								<ul class="post-tags">
									<li><i class="fa fa-user"></i>by <a href="{{route('reporter.publicProfile', $get_news->reporter->username)}}">{{$get_news->reporter->name}}</a></li>
									<li><i class="fa fa-clock-o"></i>{{banglaDate($get_news->publish_date)}} {{Carbon\Carbon::parse($get_news->publish_date)->diffForHumans()}}</li>
									<li><a href="#"><i class="fa fa-comments-o"></i><span>{{$comments->count()}}</span></a></li>
									<li><i class="fa fa-eye"></i>{{$get_news->view_counts}}</li>
									<li></li>
								</ul>
							</div>
                            <div class="advertisement">
                                <div class="desktop-advert">
                                    {!! $topOfNews !!}
                                </div>
                              
                            </div>
							<!-- comment area box -->
                            <div class="comment-area-box">
                                <div class="title-section">
                                    <h1>
                                        <span style="background: #fff;color: #000;">মন্তব্যসমূহ ({{ str_replace([1,2,3,4,5,6,7,8,9,0], ['১','২','৩','৪','৫','৬','৭','৮','৯','০'], $comments->count()) }})</span>

                                    @if(!Auth::check())
                                        <span style="background: #fff; float: right;font-size: 12px;" class="email-not-published">
                                        <a class="log-in-popup" href="#log-in-popup">কমেন্ট করতে  ক্লিক করুন </a></span>
                                    @endif
                                    </h1>
                                </div>
                                
                               <ul class="comment-tree" id="show_comment">
                                    @if(count($comments)>0)
                                        <?php $i = 1; ?>
                                        @foreach($comments as $comment)
                                        @if($comment->user)
                                        <li id="singleComment{{ $comment->id }}" style="background: #f7f7f7">
                                            <div class="comment-box">
                                                <a href="{{route('user.publicProfile', [$comment->user->username])}}">
                                                <img alt="" src="{{asset('upload/images/users')}}/{{($comment->user->photo) ?  $comment->user->photo : 'default.png'}}"></a>
                                                <div class="comment-content">
                                                    <h4><a style="float: left;border:none;" href="{{route('user.publicProfile', [$comment->user->username])}}">{{$comment->user->name}}</a> <a @guest class="log-in-popup" href="#log-in-popup" @else onclick="reply_field('{{$comment->id}}', 'reply_form')"  @endguest style="cursor: pointer;" ><i class="fa fa-comment-o"></i>Reply</a></h4>
                                                    <span><i class="fa fa-clock-o"></i>{{Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>
                                                    <p id="comment{{$comment->id}}">{{$comment->comments}}</p>
                                                    @if(Auth::check())
                                                        @if($comment->user_id == Auth::user()->id)
                                                            <a onclick="comment_edit('{{$comment->id}}')" class="comment-control">Edit</a> 
                                                            <a onclick="commentDelete('{{$comment->id}}')" class="comment-control">Delete</a>
                                                            
                                                        @endif
                                                        <a class="comment-control" onclick="reply_field('{{$comment->id}}', 'reply_form')" >Reply</a>
                                                        <!-- comment_edit form-->
                                                        <form method="get" action="{{route('comment_insert')}}" id="update_comment{{$comment->id}}" class="comment-reply-form">
                                                            <input type="hidden" value="{{$comment->id}}" name="id">
                                                             <input type="hidden" name="news_id" value="{{ $get_news->id }}">
                                                            <div id="comment_edit{{$comment->id}}"></div>
                                                        </form>
                                                    @endif
                                                </div>

                                            <form method="post" style="padding-top: 10px;" action="{{route('comment_reply', $comment->id)}}" id="reply_form{{$comment->id}}" class="comment-reply-form">
                                            
                                            </form>
                                       

                                            </div>
                                           <!--  Reply comments -->
                                            <ul class="depth" id="show_replyComment{{$comment->id}}">
                                               
                                                <?php  $replyComments = App\Models\Comment::where('comment_id', $comment->id)->get(); ?>
                                                @if($replyComments)
                                                    @foreach($replyComments as $replyComment)
                                                        @if($replyComment->user)
                                                        <li id="singleComment{{ $replyComment->id }}" style="background: #fff;">
                                                            <div class="comment-box" style="margin: 0px;">
                                                                <a  href="{{route('user.publicProfile', [$replyComment->user->username])}}"><img alt="" src="{{asset('upload/images/users')}}/{{($replyComment->user->photo) ?  $replyComment->user->photo : 'default.png'}}"></a> 
                                                                <div class="comment-content">
                                                                    <h4><a style="float: left; border:none;" href="{{route('user.publicProfile', [$replyComment->user->username])}}">{{$replyComment->user->name}} </a></h4>
                                                                    <span><i class="fa fa-clock-o"></i>{{ Carbon\Carbon::parse($replyComment->created_at)->diffForHumans()}}</span>
                                                                    <p id="reply_comment{{$replyComment->id}}">{{$replyComment->comments}}</p>

                                                                    <!-- update comment reply -->
                                                                    @if(Auth::check())
                                                                        @if($replyComment->user_id == Auth::user()->id)
                                                                            <a onclick="reply_comment_edit('{{$comment->id}}','{{$replyComment->id}}')" class="comment-control">Edit</a> 
                                                                            <a  onclick="commentDelete('{{$replyComment->id}}')" class="comment-control">Delete</a>
                                                                        @endif
                                                                        <a onclick="reply_field('{{$comment->id}}', 'reply_form', '{{$replyComment->id}}')" >Reply</a>

                                                                        <!-- show reply edit comment form -->
                                                                        <form method="post" action="{{route('comment_reply', $replyComment->id)}}" id="update_replyComment{{$replyComment->id}}" class="comment-reply-form">
                                                                        
                                                                        </form>
                                                                    @endif
                                                                <!-- end comment reply update -->
                                                                </div>

                                                                <form method="post" style="padding-top: 10px;" action="{{route('comment_reply', $comment->id)}}" id="reply_form{{$comment->id.$replyComment->id}}" class="comment-reply-form">
                                            
                                                                </form>
                                                            </div>
                                                        </li>
                                                        <?php $i++; ?>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </li>
                                        @endif
                                        @endforeach
                                       
                                    @endif
                                </ul>
                               
                            </div>
                            {{$comments->appends(request()->query())->links()}}

                            <!-- End comment area box -->
                            
                            <!-- contact form box -->
                            <div class="contact-form-box">
                                
                                @if(Auth::check())
                                <form action="{{route('comment_insert')}}"  method="get" id="comment">
                                    <label for="comment">মন্তব্য লেখুন*</label>
                                    <input type="hidden" name="news_id" value="{{ $get_news->id }}">
                                    <textarea rows="2" required id="comment" required="" placeholder="Write your comment" name="comment"></textarea> 
                                    <button type="submit" id="submit-contact">
                                        <i class="fa fa-comment"></i> মন্তব্য প্রকাশ করুন
                                    </button>
                                </form>
                                @endif
                            </div><br/>
                            <!-- End contact form box -->

							@if(count($more_news)>0)
							<!-- more news box -->
							<div class="carousel-box owl-wrapper">
								<div class="title-section">
									<h1><span>এই বিভাগের আরও খবর</span></h1>
								</div>
								<div class="row">
                                    @foreach($more_news as $news)
										<div class="col-md-3 col-sm-4 col-xs-6">
                                            <div class="news-post standard-post2">
                                                <div class="post-gallery">
                                                    <img src="{{ asset('upload/images/thumb_img/'. $news->image->source_path)}}" alt="">
                                                </div>
                                                <div class="post-title">
                                                    <h2><a href="{{route('news_details', $news->news_slug)}}">{{Str::limit($news->news_title, 40)}} </a></h2>
                                                    <ul class="post-tags">
                                                        <li><i class="fa fa-tags"></i>{{ ($news->subcategory) ? $news->subcategoryList->subcategory_bd : $news->categoryList->category_bd}}</li>

                                                        <li><i class="fa fa-clock-o"></i>{{\Carbon\Carbon::parse($news->publish_date)->diffForHumans()}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
								</div>
							</div>
							<!-- End carousel box -->
							@endif
						</div>
						<!-- End single-post box -->
					</div>
					<!-- End block content -->
                    <div class="advertisement">
                        <div class="desktop-advert">
                            {!! $bottomOfNews !!}
                        </div>
                        
                    </div>
				</div>

				<div class="col-sm-3" id="sticky-conent">
                    <div class="sidebar large-sidebar">
                        <div class="widget features-slide-widget">
                            <div class="advertisement">
                                <div class="desktop-advert">
                                    {!! $sitebarTop !!}
                                </div>
                               
                            </div>
                        </div>
                        <!-- sidebar -->
                         @include('frontend.layouts.sitebar')

                        <div class="widget features-slide-widget">
                            <div class="advertisement">
                                <div class="desktop-advert">
                                    {!! $sitebarBottom !!}
                                </div>
                                
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</section>
	<!-- End block-wrapper-section -->
            <!-- Contents of log in popup-->
        <div id="log-in-popup" class="mfp-hide white-popup">
            <form action="{{ route('login') }}" method="post" class="login-form">
                <div class="">
                    <h4> লগইন করুন</h4>
                </div>
                <hr/>
                @csrf
                    <div class="form-group">
                       <label for="mobile_or_email">ইমেইল বা মোবাইল*</label>
                        <input id="mobile_or_email"  required class="form-control" name="mobile_or_email" type="text">
                        @error('email_or_phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">পাসওয়ার্ড*</label>
                        <input id="password" required class="form-control" name="password" type="password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <input type="checkbox" name="remember"/> <span>Remember me</span>
                    </div>
                    
                    <div class="form-group">
                    <button type="submit" style="width:100%" id="submit-login">
                        <i class="fa fa-arrow-circle-right"></i>  লগইন করুন
                    </button>
                    </div>
                
                <a class="lost-password" href="#">Lost your password?</a>
                <p >Don't have account. <a href="{{route('register')}}">Register</a></p>
            </form>
            <form class="lost-password-form">
                <div class="">
                    <h4><span>Lost Password</span></h4>
                    <hr/>
                </div>
                <label for="username">ইমেইল বা মোবাইল<span>*</span></label>
                <input type="text" name="username" id="username2"/>
                <button type="submit" id="submit-login2">
                    <i class="fa fa-arrow-circle-right"></i> Submit
                </button>
                <p class="login-line">Back to <a href="#">Login</a></p>
            </form>
            
        </div>
@endsection

@section('js')



    <script>

        @if(Session::get('submitType'))
         $("#log-in-popup").click();
        @endif
    </script>
    <script type="text/javascript">


    /// comment
     $(function(){
            $("#comment").submit(function(event){
                event.preventDefault();
              
                $.ajax({
                        url:'{{route("comment_insert")}}',
                        type:'GET',
                        data:$(this).serialize(),
                        success:function(result){
                            document.getElementById("comment").reset();
                            $("#show_comment").append(result);
                             toastr.success('Comment inserted.');
                        }

                });
            });
        });  

        function reply_field(com_id, type, id=''){
            //when click reply btn hide edit from 
            $("#comment_edit"+com_id).html('');
            $("#update_replyComment"+id).html('');

            document.getElementById(type+com_id+id).innerHTML = '@csrf  <input type="hidden" name="news_id" value="{{ $get_news->id }}"> <input name="reply_comment" class="reply-box" rows="1" required  placeholder="মন্তব্য লেখুন.."><button  onclick="replyformSubmit('+com_id+', \''+type+'\', '+id+')"  type="submit"  style="float: right;">Reply</button>'
        }  

    function comment_edit(id){
        //when click edit btn hide reply from 
        $("#reply_form"+id).html('');
        var comment = document.getElementById('comment'+id).innerHTML;

        document.getElementById("comment_edit"+id).innerHTML = '<input name="com_id" type="hidden" id="commentId'+id+'" value="'+id+'">  <input type="hidden" name="news_id" value="{{ $get_news->id }}"><input class="reply-box" id="commentMsg'+id+'" name="comment" value="'+comment+'" required placeholder="Write your comment here..."><button onclick="formSubmit('+id+')" type="submit" style="float: right;">Update</button>';
    }

    function reply_comment_edit(com_id, id){
        $("#reply_form"+com_id+id).html('');
        var reply_comment = document.getElementById('reply_comment'+id).innerHTML;
    
        document.getElementById("update_replyComment"+id).innerHTML = '@csrf <input type="hidden" name="reply_id" value="'+id+'" > <input type="hidden" name="news_id" value="{{ $get_news->id }}"> <input class="reply-box" value="'+reply_comment+'" name="reply_comment" required placeholder="Write your comment here..."><button type="submit"  onclick="replyformSubmit('+id+', \'update_replyComment\')"  style="float: right;">update</button>';
    }

    //udpate comment
    function formSubmit(id){

        $("#update_comment"+id).submit(function(event){
            event.preventDefault();
           
            $.ajax({
                    url:'{{route("comment_insert")}}',
                    type:'GET',
                    data:$(this).serialize(),
                    success:function(result){
                        $("#comment"+id).html(result);
                        $("#comment_edit"+id).html('');
                         toastr.success('Comment updated');
                    }

            });
        });
    }   

    /// replay comment

    function replyformSubmit(id, type, com_id=''){

        $("#"+type+id+com_id).submit(function(event){
            event.preventDefault();
            var link = '{{route("comment_reply", ":id")}}';
            link = link.replace(':id', id);

            $.ajax({
                    url:link,
                    type:'POST',
                    data:$(this).serialize(),
                    success:function(result){
                        if(type == 'reply_form'){
                            //for insert 
                            $("#show_replyComment"+id).append(result);
                            $("#"+type+id+com_id).html('');
                             toastr.success('Comment inserted.');
                        }
                        if(type == 'update_replyComment'){
                            //for update
                            $("#reply_comment"+id).html(result);
                            $("#update_replyComment"+id).html('');
                             toastr.success('Comment updated.');
                        }
                      
                    }

            });
        });
    }


        //comment delete
    function commentDelete(com_id){
        if(confirm("Are you sure delete comment")){
            $.ajax({
                method:'get',
                url:"{{route('commentDelete')}}",
                data:{com_id:com_id},
                success:function(data){
                    
                    if(data.status == 'success'){

                        $('#singleComment'+com_id).hide();
                        toastr.success(data.msg);
                    }else{
                        toastr.error(data.msg);
                    }
                }
            });
        }else{
            return false;
        }

    }

    </script>

@endsection