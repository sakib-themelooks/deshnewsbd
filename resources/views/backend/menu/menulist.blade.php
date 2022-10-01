@extends('backend.layouts.master')
@section('title', 'Menu builder')


@section('css')
  <link href="{{asset('backend/assets')}}/node_modules/nestable/nestable.css" rel="stylesheet" type="text/css" />
  <style type="text/css">
  #main-wrapper{overflow: visible !important;}

  .panel-default{padding:0px; border-radius: 3px;    border: 1px solid #e1e1e1;  background: #f1f1f1; margin-bottom: 10px; list-style: none;}
  .item-list-body{background: #fff;padding: 5px 0 5px 10px;}
  .action_btn{ margin-top: 5px;}
  .deactive_module{background-color: #e8dada9c;}
  .panel-title>a, .panel-title>a:active{ display:block;padding:12px 0;color:#555;font-size:14px;font-weight:bold;}

  .pull-right{float: right;padding-right: 5px;}

  .panel-heading a { display: block; padding: 5px; color: #666666;font-weight: 600;}
  .item-list-footer{padding: 5px 15px 5px 0;}
  .item-list-body label{width: 100%;}
  .item-list-body{max-height: 300px;overflow-y: scroll;}
  .panel-body p{margin-bottom: 5px;}

  .form-inline{display: inline;}
  .form-inline select{padding: 4px 10px;}
  .disabled{pointer-events: none; opacity: 0.7;}
  .menulocation label{font-weight: normal;display: block; padding-left: 10px;}
  .input-box{background: #f9f9f9;padding: 5px 15px;box-sizing: border-box;margin-top: -5px;border: 1px solid #f9f9f9;}
  .input-box .form-group{width: 90%; position: relative;}
  .adjust-field{border: none;border-radius:0;position: absolute;right: 0;background: #e9ecef;padding: 9px 5px;}

</style>  
@endsection
@section('content')
       
  <div class="page-wrapper">
      <!-- ============================================================== -->
      <!-- Container fluid  -->
      <!-- ============================================================== -->
      <div class="container-fluid">
        
          <!-- ============================================================== -->
          <!-- Bread crumb and right sidebar toggle -->
          <!-- ============================================================== -->
          <div class="row page-titles">
              <div class="col-md-12 align-self-center">
                 
                  @if(count($menus) > 0)      
                  Select a menu to edit:      
                  <form action="{{route('menuBuilder')}}" method="get" class="form-inline">
                    <select required name="menu" class=" form-control">
                        <option value="">Select menu</option>
                      @foreach($menus as $menu)
                        <option @if(Request::get('menu') == $menu->id) selected @endif value="{{$menu->id}}">{{$menu->name}}</option>
                      @endforeach
                    </select>
                    <button class="btn btn-secondary">Select</button>
                  </form> 
                  or
                  @endif 
                  <a class="btn btn-outline-info" href="{{route('menuBuilder')}}?menu=new">Create a new menu</a>. 
               
              </div>
          </div>
        
        <div id="pageLoading"></div>
          <!-- ============================================================== -->
          <!-- End Bread crumb and right sidebar toggle -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Start Page Content -->
          <!-- ============================================================== -->
           
          <div class="row" style="align-items: flex-start; overflow: visible;">
              <div class="col-md-3 sticky-conent @if(count($menus) == 0 || !$desiredMenu ) disabled @endif">
                
                  <h5><span>Add Menu Items</span></h5>
                  <div class="panel-group" id="menu-items">
                    <div class="panel panel-default">
                      <div class="panel-heading" style="position:relative;">
                        <a href="#categories-list" data-toggle="collapse" data-parent="#menu-items">Categories   <span class="fa fa-angle-down pull-right"></span></a>
                        <a style="position: absolute;top: 0px;right: 30px;display: block;padding: 5px;" title="Search category items" href="#search-list" data-toggle="collapse" data-parent="#menu-items"><i class="fa fa-search"></i> </a>
                      </div>
                      <div class="panel-collapse collapse" id="search-list">
                        <input id="categoriesList" placeholder="Search items" style="width: 100%;padding: 5px;border: 1px solid #e5e5e5;" type="text" /> 
                      </div>
                      <div class="panel-collapse collapse show" id="categories-list">
                        <div class="panel-body">    
                                           
                          <div class="item-list-body categoriesList">
                            @foreach($categories as $cat)
                            <li style="margin-top:5px">
                              <label><input type="checkbox" name="select-category[]" value="{{$cat->id}}"> {{$cat->category_bd}}</label></li>
                              @foreach($cat->subcategory as $subcategory)
                              <li style="padding-left: 10px;"><label ><input type="checkbox" name="select-subcategory[]" value="{{$subcategory->id}}"> {{$subcategory->category_bd}}</label></li>

                                @foreach($subcategory->subcategory as $childcategory)
                                <li style="padding-left: 20px;"><label ><input type="checkbox" name="select-childcategory[]" value="{{$childcategory->id}}"> {{$childcategory->category_bd}}</label></li>
                                @endforeach
                              @endforeach
                            @endforeach
                          </div>    
                          <div class="item-list-footer">
                            <label for="select-all-categories" class="btn btn-sm btn-default"><input type="checkbox" id="select-all-categories"> Select All</label>
                              <button type="button" class="pull-right btn btn-secondary btn-sm" id="add-categories">Add to Menu</button>
                        </div>
                        </div>                        
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a href="#pages-list" data-toggle="collapse" data-parent="#menu-items">Pages <span class="fa fa-angle-down pull-right"></span></a>
                      </div>
                      <div class="panel-collapse collapse" id="pages-list">
                        <div class="panel-body">                      
                          <div class="item-list-body">
                            @foreach($pages as $page)
                              <label><input type="checkbox" name="select-page[]" value="{{$page->id}}"> {{$page->page_name_bd}}</label>
                            @endforeach
                          </div>  
                          <div class="item-list-footer">
                            <label class="btn btn-sm btn-default"><input type="checkbox" id="select-all-pages"> Select All</label>
                            <button type="button" id="add-pages" class="pull-right btn btn-secondary btn-sm">Add to Menu</button>
                          </div>
                        </div>                        
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <a href="#custom-links" data-toggle="collapse" data-parent="#menu-items">Custom Links <span class="fa fa-angle-down pull-right"></span></a>
                      </div>
                      <div class="panel-collapse collapse" id="custom-links">
                        <div class="panel-body">                      
                          <div class="item-list-body">
                            <div class="form-group">
                              <label>URL</label>
                              <input type="url" id="url" class="form-control" placeholder="https://">
                            </div>
                            <div class="form-group">
                              <label>Link Text</label>
                                <input type="text" id="linktext" class="form-control" placeholder="">
                            </div>
                          </div>    
                          <div class="item-list-footer" style="display: flow-root;">
                            <button type="button" class="pull-right btn btn-secondary btn-sm" id="add-custom-link">Add to Menu</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>        
              </div>
              <div class="col-md-9 sticky-conent">
                <h5><span>Menu Structure</span></h5>
                <div class="card"  style="min-height: 250px;border-radius: 3px;">
                  <div class="card-body">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                       {{Session::get('success')}}
                    </div>
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger">
                      {{Session::get('error')}}
                    </div>
                    @endif
                  @if(Request::get('menu') == 'new')
                    <h4>Create New Menu</h4>
                    <form method="post" action="{{route('createMenu')}}">
                      {{csrf_field()}}
                      <div class="row">
                        <div class="col-sm-12">
                          <label>Name</label>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">                          
                            <input type="text" name="name" placeholder="Enter menu name" class="form-control">
                          </div>
                          <button class="btn btn-sm btn-primary">Create New Menu</button>
                        </div>
                      </div>
                    </form>
                  @else
                    @if($desiredMenu)
                     <!--  //count menu items -->
                      @if(count($menuitems)>0)
                        <p>Drag each item into the order you prefer. Click the arrow on the right of the item to reveal additional configuration options.</p>

                        <div class="myadmin-dd-empty dd" id="nestable2">
                            <ol class="dd-list">
                              @foreach($menuitems as $menuitem)
                                <li class="dd-item dd3-item" id="item{{$menuitem->id}}" data-id="{{$menuitem->id}}">
                                    <div class="dd-handle dd3-handle"></div>
                                    <div class="dd3-content"> {{$menuitem->title}} <a href="#collapse{{$menuitem->id}}" class="pull-right" data-toggle="collapse"><i class="fa fa-angle-down"></i></a></div>
                                    <div class="collapse" id="collapse{{$menuitem->id}}">
                                    <div class="input-box">
                                      <form method="post" action="{{route('updateMenuItem', $menuitem->id)}}">
                                        {{csrf_field()}}
                                        <div class="form-group">
                                          <label>Title</label>
                                          <input type="text" name="title" value="{{$menuitem->title}}" class="form-control">
                                          <span class="adjust-field">
                                              <label><input id="title_hidden" @if($menuitem->title_hidden == 1) checked @endif name="title_hidden" type="checkbox" value="1"> Hidden</label>
                                          </span>
                                        </div>
                                        @if($menuitem->sourch == 'custom')
                                          <div class="form-group">
                                            <label>URL</label>
                                            <input type="text" name="url" placeholder="Exp: {{url('url')}}" value="{{$menuitem->url}}" class="form-control">
                                          </div>
                                        @endif
                                        <div class="row">
                                              <div class="col-md-6">
                                                  <select name="menu_width" class=" form-control">
                                                    <label>Menu width grid</label>
                                                    <option value="">Select width</option>
                                                    @for($i=1;$i<=12;$i++)
                                                    <option @if($menuitem->menu_width == $i) selected @endif value="{{$i}}">Grid-{{$i}}@if($i==12)(Full width)@endif</option>
                                                    @endfor
                                                  </select>
                                              </div>   
                                              <div class="col-md-6">
                                                <select name="menu_type" class=" form-control">
                                                <label>Menu Type </label>
                                                <option value="">Select width</option>
                                                <option @if($menuitem->menu_type == 'classic') selected @endif value="classic"> Classic Menu</option>
                                                <option @if($menuitem->menu_type == 'mega') selected @endif value="mega"> Mega Menu</option>
                                                <option @if($menuitem->menu_type == 'blog') selected @endif value="blog"> Blog Menu</option>
                                                <option @if($menuitem->menu_type == 'shop') selected @endif value="shop"> Shop Menu</option>
                                                <option @if($menuitem->menu_type == 'photo') selected @endif value="photo"> Banner Menu</option>
                                                </select>
                                              </div>           
                                          </div>           
                                          <div class="form-group">
                                            <label for="target{{$menuitem->id}}"><input type="checkbox" name="target" id="target{{$menuitem->id}}" value="_blank" @if($menuitem->target == '_blank') checked @endif> </label> Open in a new tab
                                          </div>
                                        
                                        <div class="form-group">
                                          <button class="btn btn-sm btn-success">Save</button>
                                          <a href="javascript:void(0)" onclick="deleteMenuItem({{$menuitem->id}})" class="btn btn-sm btn-danger">Delete</a>
                                        </div>
                                      </form>
                                    </div>
                                    </div>
                                    @if(count($menuitem->subMenus)>0)
                                    <ol class="dd-list">
                                      @foreach($menuitem->subMenus as $subMenu)
                                        <li class="dd-item dd3-item" id="item{{$subMenu->id}}" data-id="{{$subMenu->id}}">
                                            <div class="dd-handle dd3-handle"></div>
                                            <div class="dd3-content"> {{$subMenu->title}} <a href="#collapse{{$subMenu->id}}" class="pull-right" data-toggle="collapse"><i class="fa fa-angle-down"></i></a></div>
                                            <div class="collapse" id="collapse{{$subMenu->id}}">
                                              <div class="input-box">
                                                <form method="post" action="{{route('updateMenuItem', $subMenu->id)}}">
                                                  {{csrf_field()}}
                                                  <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" name="title" value="{{$subMenu->title}}" class="form-control">
                                                    <span class="adjust-field">
                                                      <label><input id="title_hidden" @if($subMenu->title_hidden == 1) checked @endif name="title_hidden" type="checkbox" value="1"> Hidden</label>
                                                  </span>
                                                  </div>
                                                  @if($subMenu->sourch == 'custom')
                                                    <div class="form-group">
                                                      <label>URL</label>
                                                      <input type="text" name="url" placeholder="Exp: {{url('url')}}" value="{{$subMenu->url}}" class="form-control">
                                                    </div>  
                                                  @endif 
                                                    <div class="form-group">
                                                        <label>Menu width grid</label>
                                                        <select name="menu_width" class=" form-control">
                                                          <option value="">Select width</option>
                                                          @for($i=1;$i<=12;$i++)
                                                          <option @if($subMenu->menu_width == $i) selected @endif value="{{$i}}">Grid-{{$i}}@if($i==12)(Full width)@endif</option>
                                                          @endfor
                                                        </select>
                                                    </div> 
                                                    <div class="col-md-6">
                                                        <select name="menu_type" class=" form-control">
                                                        <label>Menu Type </label>
                                                        <option value="">Select width</option>
                                                        <option @if($menuitem->menu_type == 'left') selected @endif value="left"> Left Menu</option>
                                                        <option @if($menuitem->menu_type == 'right') selected @endif value="right"> Right Menu</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                      <label for="target{{$subMenu->id}}"><input type="checkbox" name="target"  value="_blank" @if($subMenu->target == '_blank') checked @endif> </label> Open in a new tab
                                                    </div>
                                                  
                                                  <div class="form-group">
                                                    <button class="btn btn-sm btn-success">Save</button>
                                                    <a href="javascript:void(0)" onclick="deleteMenuItem({{$subMenu->id}})" class="btn btn-sm btn-danger">Delete</a>
                                                  </div>
                                                </form>
                                              </div>
                                            </div>
                                            @if(count($subMenu->subMenus)>0)
                                            <ol class="dd-list">
                                              @foreach($subMenu->subMenus as $childMenu)
                                                <li class="dd-item dd3-item" id="item{{$childMenu->id}}" data-id="{{$childMenu->id}}">
                                                    <div class="dd-handle dd3-handle"></div>
                                                    <div class="dd3-content"> {{$childMenu->title}} <a href="#collapse{{$childMenu->id}}" class="pull-right" data-toggle="collapse"><i class="fa fa-angle-down"></i></a></div>
                                                    <div class="collapse" id="collapse{{$childMenu->id}}">
                                                      <div class="input-box">
                                                        <form method="post" action="{{route('updateMenuItem', $childMenu->id)}}">
                                                          {{csrf_field()}}
                                                          <div class="form-group">
                                                            <label>Title</label>
                                                            <input type="text" name="title" value="{{$childMenu->title}}" class="form-control">
                                                            <span class="adjust-field">
                                                              <label><input id="title_hidden" @if($childMenu->title_hidden == 1) checked @endif  name="title_hidden" type="checkbox" value="1"> Hidden</label>
                                                          </span>
                                                          </div>
                                                          @if($childMenu->sourch == 'custom')
                                                            <div class="form-group">
                                                              <label>URL</label>
                                                              <input type="text" name="url" placeholder="Exp: {{url('url')}}" value="{{$childMenu->url}}" class="form-control">
                                                            </div> 
                                                            @endif  
                                                            <div class="form-group">
                                                              <label>Menu width grid</label>
                                                            <select  name="menu_width" class=" form-control">
                                                              <option value="">Select width</option>
                                                              @for($i=1;$i<=12;$i++)
                                                              <option @if($childMenu->menu_width == $i) selected @endif  value="{{$i}}">Grid-{{$i}}@if($i==12)(Full width)@endif</option>
                                                              @endfor
                                                            </select>
                                                            </div>                
                                                            <div class="form-group">
                                                              <label><input type="checkbox" name="target" value="_blank" @if($childMenu->target == '_blank') checked @endif> </label> Open in a new tab
                                                            </div>
                                                          
                                                          <div class="form-group">
                                                            <button class="btn btn-sm btn-success">Save</button>
                                                            <a href="javascript:void(0)" onclick="deleteMenuItem({{$childMenu->id}})" class="btn btn-sm btn-danger">Delete</a>
                                                          </div>
                                                        </form>
                                                      </div>
                                                    </div>
                                                </li>
                                              @endforeach
                                            </ol>
                                            @endif
                                        </li>
                                      @endforeach
                                    </ol>
                                    @endif
                                </li>
                              @endforeach
                            </ol>
                        </div>
                      @else
                        <h5>Menu item not found, please add menu items from the column on the left.</h5>
                      @endif 
                        <div class="form-group menulocation">
                          <b>Menu Location</b>
                          <label><input type="radio" required name="location" value="top_header" @if($desiredMenu->location == 'top_header') checked @endif> Top Header</label>
                          <label><input type="radio" required name="location" value="main_header" @if($desiredMenu->location == 'main_header') checked @endif> Main Navigation</label>
                          <label><input type="radio" required name="location" value="footer" @if($desiredMenu->location == 'footer') checked @endif> Footer Navigation</label>
                          <p id="location" style="color: red;"></p>
                        </div> 
                        <div class="row"> 
                          <div class="col-6 col-md-3 text-left">
                             <a class="btn btn-outline-danger btn-sm" href="{{route('deleteMenu',$desiredMenu->id)}}">Delete Menu</a>
                           </div>
                          <div class="col-6 text-right">
                            <button class="btn btn-sm btn-info" id="saveMenu">Set Menu Location</button>
                          </div>
                        </div>
                    @else
                      <h5>Please create a new menu or select the menu from the top left.</h5>
                    @endif 
                  @endif 
                  </div>
                </div>
            </div>
          </div>
      </div>
      <!-- ============================================================== -->
      <!-- End Container fluid  -->
      <!-- ============================================================== -->
  </div>

@endsection
@section('js')
    <!--Nestable js -->
    <script src="{{asset('backend/assets')}}/node_modules/nestable/jquery.nestable.js"></script>
 @if($desiredMenu)
    <script>
    $(function(){

    $('#categoriesList').keyup(function(){
        var searchText = $(this).val().toUpperCase();
        $('.categoriesList li label').each(function(){
            var currentLiText = $(this).text(),
                showCurrentLi = currentLiText.toUpperCase().indexOf(searchText) !== -1;
            $(this).toggle(showCurrentLi);
            });     
          });
      });

      $('.dd').nestable({maxDepth: 3});
   
      $('#saveMenu').click(function(){
        var menuid = <?=$desiredMenu->id?>;
        var location = $('input[name="location"]:checked').val();
        if(!location){
          $('#location').html('Please select location.');
          return false
        }
        var itemids = JSON.stringify($('.dd').nestable('serialize'));

        $.ajax({
          type:"get",
          data: {menuid:menuid,itemids:itemids,location:location},
          url: "{{route('updateMenu')}}",              
          success:function(res){
            window.location.reload();
          }
        })    
      });

      //save data on drag
      $('.dd').on('change', function (e) {

        var menuid = <?=$desiredMenu->id?>;
        var location = $('input[name="location"]:checked').val();
        if(!location){
          location = 'main_header'
        }
        var itemids = JSON.stringify($('.dd').nestable('serialize'));

        $.ajax({
          type:"get",
          data: {menuid:menuid,itemids:itemids,location:location},
          url: "{{route('updateMenu')}}",              
          success:function(res){
            
          }
        }) 
      });


          function deleteMenuItem(id) {
            @if(env('MODE') == 'demo')
            toastr.error('Demo mode on delete not working');
            return false;
            @endif
            var route = '{{ route("deleteMenuItem", ":id") }}';
            route = route.replace(":id", id);
            var item = $('#item').val();
            $.ajax({
                url:route,
                method:"get",
                success:function(data){
                    if(data.status){
                        $("#item"+id).remove();
                        toastr.error(data.msg);
                    }else{
                        toastr.error(data.msg);
                    }
                }
            });
        }
    </script>
  
        <script>
          $('#select-all-categories').click(function(event) {
            if(this.checked) {
              $('#categories-list :checkbox').each(function() {
                this.checked = true;                        
              });
            }else{
              $('#categories-list :checkbox').each(function() {
                this.checked = false;                        
              });
            }
          });
        </script>
        <script>
          $('#select-all-pages').click(function(event) {   
            if(this.checked) {
              $('#pages-list :checkbox').each(function() {
                this.checked = true;                        
              });
            }else{
              $('#pages-list :checkbox').each(function() {
                this.checked = false;                        
              });
            }
          });
        </script>
        <script>
          $('#select-all-banners').click(function(event) {   
            if(this.checked) {
              $('#banners-list :checkbox').each(function() {
                this.checked = true;                        
              });
            }else{
              $('#banners-list :checkbox').each(function() {
                this.checked = false;                        
              });
            }
          });
        </script>

<script>
  $('#add-categories').click(function(){
    document.getElementById('pageLoading').style.display = 'block';
    var menuid = <?=$desiredMenu->id?>;
    var ids =  [];

    $.each($("input[name='select-category[]']:checked"), function(){            
      ids.push($(this).val());
    });
     var subids = [];
    $.each($("input[name='select-subcategory[]']:checked"), function(){            
      subids.push($(this).val());
    });
    var childids = [];
   
    $.each($("input[name='select-childcategory[]']:checked"), function(){            
      childids.push($(this).val());
    });
    if(ids.length == 0 && subids.length && childids.length == 0){
      return false;
    }
    $.ajax({
      type:"get",
      data: {menuid:menuid,ids:ids,subids:subids,childids:childids,sourch:'category'},
      url: "{{route('addItemToMenu')}}",               
      success:function(res){              
        location.reload();
      }
    })
  });

  $('#add-pages').click(function(){
    document.getElementById('pageLoading').style.display = 'block';
    var menuid = <?=$desiredMenu->id?>;
    var ids = [];
    $.each($("input[name='select-page[]']:checked"), function(){            
      ids.push($(this).val());
    });
    if(ids.length == 0){
      return false;
    }
    $.ajax({
      type:"get",
      data: {menuid:menuid,ids:ids,sourch:'page'},
      url: "{{route('addItemToMenu')}}",               
      success:function(res){              
        location.reload();
      }
    })
  });

  $('#add-banners').click(function(){
    document.getElementById('pageLoading').style.display = 'block';
    var menuid = <?=$desiredMenu->id?>;
    var n = $('input[name="select-banners[]"]:checked').length;
    var array = $('input[name="select-banners[]"]:checked');
    var ids = [];
    for(i=0;i<n;i++){
      ids[i] =  array.eq(i).val();
    }
    if(ids.length == 0){
      return false;
    }
    $.ajax({
      type:"get",
      data: {menuid:menuid,ids:ids,sourch:'banner'},
      url: "{{route('addItemToMenu')}}",             
      success:function(res){
        location.reload();
      }
    })
  });

  $("#add-custom-link").click(function(){
    document.getElementById('pageLoading').style.display = 'block';
    var menuid = <?=$desiredMenu->id?>;
    var url = $('#url').val();
    var link = $('#linktext').val();
    if(url.length > 0 && link.length > 0){
      $.ajax({
        type:"get",
        data: {menuid:menuid,url:url,link:link,sourch:'custom'},
        url: "{{route('addItemToMenu')}}",                
        success:function(res){
          location.reload();
        }
      })
    }
  });
</script>
@endif 
@endsection
