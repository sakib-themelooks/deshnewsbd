<div class="{{$section_item->colmd}} pps">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <?php $i = 1;?>
    <div class="containerss">
        <div class="holder">
          <!-- main images -->
            @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
                <a class="slides slidersection_news_img" href="{{route('newsDetails', [$section_news->getCategory->slug, $section_news->id])}}">
                    <div class="col-md-12 col-xs-12 slider2_news_imgs pps videos">
                        @if($section_news->thumb_name)
                        <i class="fa fa-play" aria-hidden="true"></i>
                        @endif
                        @if($section_item->lazyload)
                        <img class="lazyload" src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}" data-src="{{ asset('upload/images/news/'. $section_news->image->source_path)}}"  alt="{{$section_news->news_title}}">
                        @elseif($section_news->image)
                        <img src="{{ asset('upload/images/news/'. $section_news->image->source_path)}}"  alt="{{$section_news->news_title}}">
                        @else
                        <img src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}"  alt="{{$section_news->news_title}}">
                        @endif
                    </div>
                </a>
                <?php $i++; ?>
            @endforeach
        </div>
      <div class="prevContainer"><a class="prev" onclick="plusSlides(-1)">
        <svg viewBox="0 0 24 24">
        <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"></path>
    </svg>
        </a></div>
      <div class="nextContainer"><a class="next" onclick="plusSlides(1)">
        <svg viewBox="0 0 24 24">
      <path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
    </svg>
        </a></div>
    
      <div class="caption-container">
        <p id="caption"></p>
      </div>
    
      <!-- thumnails in a row -->
      <div class="row">
        <?php $i = 1;?>
        @foreach($section_item->newsByCategory->take($section_item->item_number) as $section_news)
                <div class="column slider2_news_imgs pps videos">
                    @if($section_news->thumb_name)
                    <i class="fa fa-play" aria-hidden="true"></i>
                    @endif
                    @if($section_item->lazyload)
                    <img class="slide-thumbnail lazyload" src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}" data-src="{{ asset('upload/images/news/'. $section_news->image->source_path)}}"  alt="{{$section_news->news_title}}" onclick="currentSlide({{$i}})">
                    @elseif($section_news->image)
                    <img class="slide-thumbnail" src="{{ asset('upload/images/news/'. $section_news->image->source_path)}}"  alt="{{$section_news->news_title}}" onclick="currentSlide({{$i}})">
                    @else
                    <img class="slide-thumbnail" src="{{ asset('upload/images/logo/'.config('siteSetting.default_logo'))}}"  alt="{{$section_news->news_title}}">
                    @endif
                </div>
            <?php $i++; ?>
        @endforeach
      </div>
</div>
</div>
<style>

.holder::-webkit-scrollbar {
  display: none;
}

/* Hide the images by default */
.slides {
  display: none;
  /* max-width: 1000px; */
  /* width: 100%;
  flex-shrink: 0;
  height: 100%; */
}

.slides img {
  width: 100%;
}

/* Smartphones (portrait and landscape) ----------- */
@media only screen and (max-width: 600px) {
  .prevContainer,
  .nextContainer {
    display: none;
    visibility: hidden;
  }
  .caption-container p {
    position: absolute;
    bottom: 36px !important;
}
}

.prevContainer,
.nextContainer {
  background-color: rgba(0, 0, 0, 0.3);
  position: absolute;
  top: 50%;
  transform: translate(0, calc(-50% - 54px));
  height: 54px;
  width: 54px;
  cursor: pointer;
}

.prevContainer {
  margin-left: 0;
  left: 0;
  border-radius: 0 30px 30px 0;
}

.prev {
  position: relative;
  top: 50%;
  transform: translate(0, -50%);
  height: 34px;
  width: 32px;
  float: left;
  margin-left: 12px
}

.prev svg,
.next svg {
  fill: white;
}

.nextContainer {
  margin-right: 0;
  right: 0;
  border-radius: 30px 0 0 30px;
}

.next {
  position: relative;
  top: 50%;
  transform: translate(0, -50%);
  height: 34px;
  width: 32px;
  float: right;
  margin-right: 12px;
}

/* Container for image text */
.caption-container p {
    text-align: left;
    background: linear-gradient(360deg,#000,#00000000);
    padding: 2px 16px;
    color: white;
    position: absolute;
    bottom: 78px;
    width: 100%;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Six columns side by side */
.column {
  float: left;
  width: 16.66%;
}

/* Add a transparency effect for thumbnail images */
.slide-thumbnail {
  width: 100%;
  opacity: 0.6;
  cursor: pointer;
}

.active,
.slide-thumbnail:hover {
  opacity: 1;
}
</style>
<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("slides");
  var dots = document.getElementsByClassName("slide-thumbnail");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  console.log(slideIndex);

  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
      // slides[i].style.display = "inline";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  // slides[slideIndex-1].style.display = "inline";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>