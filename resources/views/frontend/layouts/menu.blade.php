<div class="ruby-menu-demo-header">
    <div class="ruby-wrapper">
        <ul class="container ruby-menu">
            @foreach($menuitems as $menuitem)
            @if($menuitem->menu_type == 'mega')
            
            <li class="ruby-menu-mega"><a class="home @if(count($menuitem->subMenus)>0) dropdownIcon @endif" href="{{ url($menuitem->url) }}">{{$menuitem->title}}</a>
            @if(count($menuitem->subMenus)>0)
            <div class="ruby-grid ruby-grid-lined">
              <div class="ruby-row">
                @foreach($menuitem->subMenus as $subMenu)
                <div class="ruby-col-{{($subMenu->menu_width) ? $subMenu->menu_width : 3}}">
                  <a href="{{url($subMenu->url)}}" class="main-menu @if($subMenu->title_hidden == 1) hidden @endif "><h3 class="ruby-list-heading">{{$subMenu->title}}</h3></a>
                  @if(count($subMenu->childMenus)>0)
                  <div class="row">
                    @foreach($subMenu->childMenus as $childMenu)
                    <a target="{{ $childMenu->target }}" class="col-md-{{($childMenu->menu_width) ? $childMenu->menu_width : 12}} @if($childMenu->title_hidden == 1) hidden @endif" href="{{$childMenu->url}}">{{$childMenu->title}}</a>
                    @endforeach
                  </div>
                  @endif
                </div>
                @endforeach
              </div>
            </div>
            @endif
           </li>
          
            @elseif($menuitem->menu_type == 'blog')
            <li class="ruby-menu-mega-blog"><a class="home @if(count($menuitem->subMenus)>0) dropdownIcon @endif" href="{{ url($menuitem->url) }}">{{$menuitem->title}}</a>
            @if(count($menuitem->subMenus)>0)
            <div style="height: 269.359px;" class="">
              <ul class="ruby-menu-mega-blog-nav">
                @foreach($menuitem->subMenus as $subMenu)
                <li class="ruby-active-menu-item"><a href="{{url($subMenu->url)}}" class="main-menu @if($subMenu->title_hidden == 1) hidden @endif ">{{$subMenu->title}}</a>
                  @if(count($subMenu->childMenus)>0)
                  <div class="row">
                    @foreach($subMenu->childMenus as $childMenu)
                    <a target="{{ $childMenu->target }}" class="col-md-{{($childMenu->menu_width) ? $childMenu->menu_width : 12}} @if($childMenu->title_hidden == 1) hidden @endif" href="{{$childMenu->url}}">{{$childMenu->title}}</a>
                    @endforeach
                  </div>
                  @endif
                </li>
                @endforeach
              </ul>
            </div>
            @endif
            </li>
            @elseif($menuitem->menu_type == 'shop')
            <li class="ruby-menu-mega-shop"><a href="#">Shop</a>
            <div style="height: 263px;" class="">
              <ul>
                <li class="ruby-active-menu-item"><a href="#">Clothing</a>
                  <div class="ruby-grid ruby-grid-lined">
                    <div class="ruby-row">
                      <div class="ruby-col-2">
                        <h3 class="ruby-list-heading">TOPS</h3>
                        <ul>
                          <li><a href="#">Menu Item #1</a></li>
                          <li><a href="#">Menu Item #2</a></li>
                          <li><a href="#">Menu Item #3</a></li>
                          <li><a href="#">Menu Item #4</a></li>
                          <li><a href="#">Menu Item #5</a></li>
                        </ul>
                      </div>
                      <div class="ruby-col-2">
                        <img src="img/outerwear-2.jpg">
                      </div>
                      <div class="ruby-col-2">
                        <h3 class="ruby-list-heading">BOTTOM</h3>
                        <ul>
                          <li><a href="#">Menu Item #1</a></li>
                          <li><a href="#">Menu Item #2</a></li>
                          <li><a href="#">Menu Item #3</a></li>
                          <li><a href="#">Menu Item #4</a></li>
                          <li><a href="#">Menu Item #5</a></li>
                        </ul>
                      </div>
                      <div class="ruby-col-2">
                        <h3 class="ruby-list-heading">NIGHTWEAR</h3>
                        <ul>
                          <li><a href="#">Menu Item #1</a></li>
                          <li><a href="#">Menu Item #2</a></li>
                          <li><a href="#">Menu Item #3</a></li>
                          <li><a href="#">Menu Item #4</a></li>
                          <li><a href="#">Menu Item #5</a></li>
                        </ul>
                      </div>
                      <div class="ruby-col-2">
                        <img src="img/outerwear-3.jpg">
                      </div>
                      <div class="ruby-col-2">
                        <h3 class="ruby-list-heading">SWIMWEAR</h3>
                        <ul>
                          <li><a href="#">Menu Item #1</a></li>
                          <li><a href="#">Menu Item #2</a></li>
                          <li><a href="#">Menu Item #3</a></li>
                          <li><a href="#">Menu Item #4</a></li>
                          <li><a href="#">Menu Item #5</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                <span class="ruby-dropdown-toggle"></span></li>
                <li><a href="#">Outerwear</a>
                  <div class="ruby-grid ruby-grid-lined">
                    <div class="ruby-row">
                      <div class="ruby-col-3">
                        <img src="img/outerwear.jpg">
                      </div>
                      <div class="ruby-col-3">
                        <h3 class="ruby-list-heading">COATS</h3>
                        <ul>
                          <li><a href="#">Menu Item #1</a></li>
                          <li><a href="#">Menu Item #2</a></li>
                          <li><a href="#">Menu Item #3</a></li>
                          <li><a href="#">Menu Item #4</a></li>
                          <li><a href="#">Menu Item #5</a></li>
                          <li><a href="#">Menu Item #6</a></li>
                          <li><a href="#">Menu Item #7</a></li>
                        </ul>
                      </div>
                      <div class="ruby-col-3">
                        <h3 class="ruby-list-heading">JACKETS</h3>
                        <ul>
                          <li><a href="#">Menu Item #1</a></li>
                          <li><a href="#">Menu Item #2</a></li>
                          <li><a href="#">Menu Item #3</a></li>
                          <li><a href="#">Menu Item #4</a></li>
                          <li><a href="#">Menu Item #5</a></li>
                          <li><a href="#">Menu Item #6</a></li>
                          <li><a href="#">Menu Item #7</a></li>
                        </ul>
                      </div>
                      <div class="ruby-col-3">
                        <h3 class="ruby-list-heading">LEATHER</h3>
                        <ul>
                          <li><a href="#">Menu Item #1</a></li>
                          <li><a href="#">Menu Item #2</a></li>
                          <li><a href="#">Menu Item #3</a></li>
                          <li><a href="#">Menu Item #4</a></li>
                          <li><a href="#">Menu Item #5</a></li>
                          <li><a href="#">Menu Item #6</a></li>
                          <li><a href="#">Menu Item #7</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                <span class="ruby-dropdown-toggle"></span></li>
                <li><a href="#">Bags &amp; Shoes</a>
                  <div class="ruby-grid ruby-grid-lined">
                    <div class="ruby-row">
                      <div class="ruby-col-3">
                        <img src="img/bags.jpg">
                      </div>
                      <div class="ruby-col-3">
                        <h3 class="ruby-list-heading">BAGS</h3>
                        <ul>
                          <li><a href="#">Menu Item #1</a></li>
                          <li><a href="#">Menu Item #2</a></li>
                          <li><a href="#">Menu Item #3</a></li>
                          <li><a href="#">Menu Item #4</a></li>
                          <li><a href="#">Menu Item #5</a></li>
                        </ul>
                      </div>
                      <div class="ruby-col-3">
                        <h3 class="ruby-list-heading">SHOES</h3>
                        <ul>
                          <li><a href="#">Menu Item #1</a></li>
                          <li><a href="#">Menu Item #2</a></li>
                          <li><a href="#">Menu Item #3</a></li>
                          <li><a href="#">Menu Item #4</a></li>
                          <li><a href="#">Menu Item #5</a></li>
                        </ul>
                      </div>
                      <div class="ruby-col-3">
                        <img src="img/shoes.jpg">
                      </div>
                    </div>
                  </div>
                <span class="ruby-dropdown-toggle"></span></li>
                <li><a href="#">Accessories</a>
                  <div class="ruby-grid ruby-grid-lined">
                    <div class="ruby-row">
                      <div class="ruby-col-3">
                        <img src="img/eyewear.jpg">
                        <h3 class="ruby-list-heading" style="margin-top: 16px;">EYEWEAR</h3>
                        <ul>
                          <li><a href="#">Menu Item #1</a></li>
                          <li><a href="#">Menu Item #2</a></li>
                          <li><a href="#">Menu Item #3</a></li>
                          <li><a href="#">Menu Item #4</a></li>
                        </ul>
                      </div>
                      <div class="ruby-col-3">
                        <img src="img/jewellery.jpg">
                        <h3 class="ruby-list-heading" style="margin-top: 16px;">JEWELLERY</h3>
                        <ul>
                          <li><a href="#">Menu Item #1</a></li>
                          <li><a href="#">Menu Item #2</a></li>
                          <li><a href="#">Menu Item #3</a></li>
                          <li><a href="#">Menu Item #4</a></li>
                        </ul>
                      </div>
                      <div class="ruby-col-3">
                        <img src="img/watches.jpg">
                        <h3 class="ruby-list-heading" style="margin-top: 16px;">WATCHES</h3>
                        <ul>
                          <li><a href="#">Menu Item #1</a></li>
                          <li><a href="#">Menu Item #2</a></li>
                          <li><a href="#">Menu Item #3</a></li>
                          <li><a href="#">Menu Item #4</a></li>
                        </ul>
                      </div>
                      <div class="ruby-col-3">
                        <img src="img/textile.jpg">
                        <h3 class="ruby-list-heading" style="margin-top: 16px;">OTHERS</h3>
                        <ul>
                          <li><a href="#">Menu Item #1</a></li>
                          <li><a href="#">Menu Item #2</a></li>
                          <li><a href="#">Menu Item #3</a></li>
                          <li><a href="#">Menu Item #4</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                <span class="ruby-dropdown-toggle"></span></li>
                <li><a href="#">Collections</a>
                  <div class="ruby-grid ruby-grid-lined">
                    <div class="ruby-row">
                      <div class="ruby-col-3">
                        <img src="img/collection-accessori.jpg">
                      </div>
                      <div class="ruby-col-3">
                        <img src="img/collection-bridal.jpg">
                      </div>
                      <div class="ruby-col-3">
                        <img src="img/collection-cube.jpg">
                      </div>
                      <div class="ruby-col-3">
                        <img src="img/collection-elegante.jpg">
                      </div>
                    </div>
                    <div class="ruby-row">
                      <div class="ruby-col-3">
                        <img src="img/collection-maxmara.jpg">
                      </div>
                      <div class="ruby-col-3">
                        <img src="img/collection-sfilata.jpg">
                      </div>
                      <div class="ruby-col-3">
                        <img src="img/collection-shine.jpg">
                      </div>
                      <div class="ruby-col-3">
                        <img src="img/collection-s-maxmara.jpg">
                      </div>
                    </div>
                  </div>
                <span class="ruby-dropdown-toggle"></span></li>
              </ul>
            </div>
          <span class="ruby-dropdown-toggle"></span></li>

            @elseif($menuitem->menu_type == 'photo')
            @else
            <li><a class="home @if(count($menuitem->subMenus)>0) dropdownIcon @endif" href="{{ url($menuitem->url) }}">{{$menuitem->title}}</a>
                @if(count($menuitem->subMenus)>0)
                <ul class="">
                    @foreach($menuitem->subMenus as $subMenu)
                    <li><a href="{{url($subMenu->url)}}" class="main-menu @if($subMenu->title_hidden == 1) hidden @endif ">{{$subMenu->title}}</a>
                        @if(count($subMenu->childMenus)>0)
                        <ul>
                            @foreach($subMenu->childMenus as $childMenu)
                            <li><a target="{{ $childMenu->target }}" class="@if($childMenu->title_hidden == 1) hidden @endif" href="{{$childMenu->url}}">{{$childMenu->title}}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    @endforeach
                </ul>
                @endif
            @endif
            @endforeach
        </ul>
     </div>
</div>