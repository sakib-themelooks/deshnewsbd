<input type="hidden" value="{{$section->id}}" name="id">

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="item_title">Section Title</label>
            <input placeholder="Enter Title" name="item_title" id="item_title" value="{{$section->item_title}}" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="item_title_number">Style</label>
            <select required name="item_title_number" class="form-control">
                @for($i=1; $i<=20; $i++)
                <option value="{{$i}}"  @if($section->item_title_number == ''.$i) selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="item_sub_title">Sub Title</label>
            <input  name="item_sub_title" placeholder="Enter sub title" id="item_sub_title" value="{{$section->item_sub_title}}" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="required" for="category_id">Select category</label>
            <select required name="category_id" id="category_id" class="select2 form-control custom-select">
              
               <option value="">Select category</option>
               @foreach($categories as $category)
                    <option  @if($category->id == $section->item_id) selected @endif value="{{$category->id}}">{{$category->category_bd}}</option>
                   
               @endforeach
            </select>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label for="name required">Section Layout</label>
            <select required name="section_layout" class="form-control">
                @for($i=1; $i<=20; $i++)
                <option value="grid-{{$i}}"  @if($section->section_layout == 'grid-'.$i) selected @endif>Modern Grid {{$i}}</option>
                @endfor
                @for($i=1; $i<=20; $i++)
                <option value="mix-{{$i}}"  @if($section->section_layout == 'mix-'.$i) selected @endif>Mix {{$i}}</option>
                @endfor
                @for($i=1; $i<=2; $i++)
                <option value="gridlisting-{{$i}}"  @if($section->section_layout == 'gridlisting-'.$i) selected @endif>Grid Listing {{$i}}</option>
                @endfor
                @for($i=1; $i<=4; $i++)
                <option value="blog-{{$i}}"  @if($section->section_layout == 'blog-'.$i) selected @endif>Blog Listing {{$i}}</option>
                @endfor
                @for($i=1; $i<=5; $i++)
                <option value="thumbnail-{{$i}}"  @if($section->section_layout == 'thumbnail-'.$i) selected @endif>Thumbnail Listing {{$i}}</option>
                @endfor
                @for($i=1; $i<=2; $i++)
                <option value="text-{{$i}}"  @if($section->section_layout == 'text-'.$i) selected @endif>Text Listing {{$i}}</option>
                @endfor
                @for($i=1; $i<=2; $i++)
                <option value="tall-{{$i}}"  @if($section->section_layout == 'tall-'.$i) selected @endif>Tall Listing {{$i}}</option>
                @endfor
                @for($i=1; $i<=3; $i++)
                <option value="slider-{{$i}}"  @if($section->section_layout == 'slider-'.$i) selected @endif>Slider {{$i}}</option>
                @endfor
                @for($i=1; $i<=5; $i++)
                <option value="scroll-{{$i}}"  @if($section->section_layout == 'scroll-'.$i) selected @endif>Scroll {{$i}}</option>
                @endfor
                @for($i=1; $i<=5; $i++)
                <option value="feature-{{$i}}"  @if($section->section_layout == 'feature-'.$i) selected @endif>Feature News {{$i}}</option>
                @endfor
                @for($i=1; $i<=2; $i++)
                <option value="city-{{$i}}"  @if($section->section_layout == 'city-'.$i) selected @endif>City News {{$i}}</option>
                @endfor
                @for($i=1; $i<=2; $i++)
                <option value="rss-{{$i}}"  @if($section->section_layout == 'rss-'.$i) selected @endif>Rss News {{$i}}</option>
                @endfor
                @for($i=1; $i<=1; $i++)
                <option value="ads-{{$i}}"  @if($section->section_layout == 'ads-'.$i) selected @endif>Ads {{$i}}</option>
                @endfor
                @for($i=1; $i<=5; $i++)
                <option value="banner-{{$i}}"  @if($section->section_layout == 'banner-'.$i) selected @endif>Banner {{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
    
 
    <div class="col-md-3">
        <div class="form-group">
            <label class="required" for="background_color">Title BG Color</label>
            <input type="text" name="background_color" id="background_color" value="{{$section->background_color}}" class="form-control gradient-colorpicker" >
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
            <label class="required" for="name">Title Color</label>
            <input name="text_color" value="{{$section->text_color}}" class="gradient-colorpicker form-control" >
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="required" for="bg_text">Box BG Color</label>
            <input type="text" name="bg_text" id="bg_text" value="{{$section->bg_text}}" class="form-control gradient-colorpicker" >
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
            <label class="required" for="bt_text">Box Color</label>
            <input name="bt_text" id="bt_text" value="{{$section->bt_text}}" class="gradient-colorpicker form-control" >
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="form-group">
            <label class="required">Padding</label>
            <input type="text" value="{{$section->padding}}" class="form-control" placeholder="Example: 7" name="padding">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="required">Margin</label>
            <input type="text" value="{{$section->margin}}" class="form-control" placeholder="Example: 7" name="margin">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="required">Number Of Item</label>
            <input type="number" value="{{$section->item_number}}" class="form-control" placeholder="Example: 7" name="item_number">
        </div>
    </div>
    
    
    <div class="col-md-3">
        <div class="form-group">
            <label for="colmd">Desktop</label>
            <select required name="colmd" class="form-control">
                @for($i=1; $i<=12; $i++)
                <option value="col-md-{{$i}}"  @if($section->colmd == 'col-md-'.$i) selected @endif>col-md-{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="colxs">Grid</label>
            <select required name="colxs" class="form-control">
                @for($i=1; $i<=12; $i++)
                <option value="{{$i}}"  @if($section->colxs == ''.$i) selected @endif>Grid {{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="device">Cat / Time</label>
            <select name="device" class="form-control">
                <option value=""  @if($section->device == '') selected @endif>Off</option>
                <option value="1"  @if($section->device == '1') selected @endif>On</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="lazyload">Lazyload</label>
            <select required name="lazyload" class="form-control">
                <option value="on"  @if($section->lazyload == 'on') selected @endif>On</option>
                <option value=""  @if($section->lazyload == '') selected @endif>Off</option>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="switch-box">Status</label>
            <div  class="status-btn" >
                <div class="custom-control custom-switch">
                    <input name="status" {{($section->status == 1) ?  'checked' : ''}}   type="checkbox" class="custom-control-input" id="status-edit">
                    <label  class="custom-control-label" for="status-edit">Publish/UnPublish</label>
                </div>
            </div>
        </div>
    </div>
</div>
                           