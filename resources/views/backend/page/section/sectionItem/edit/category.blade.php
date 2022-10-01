<input type="hidden" value="{{$sectionItem->id}}" name="id">

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="item_title">Section Title</label>
            <input placeholder="Enter Title" name="item_title" id="item_title" value="{{$sectionItem->item_title}}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="icon">icon cloass</label>
            <input placeholder="Enter icon class" name="icon" id="icon" value="{{$sectionItem->icon}}" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label for="item_title_number">Style</label>
            <select required name="item_title_number" class="form-control">
                @for($i=1; $i<=20; $i++)
                <option value="{{$i}}"  @if($sectionItem->item_title_number == ''.$i) selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="item_sub_title">Sub Title</label>
            <input  name="item_sub_title" placeholder="Enter sub title" id="item_sub_title" value="{{$sectionItem->item_sub_title}}" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="required" for="category_id">Select category</label>
            <select required name="category_id" id="category_id" class="select2 form-control custom-select">
              
               <option value="">Select category</option>
               @foreach($categories as $category)
                    <option  @if($category->id == $sectionItem->item_id) selected @endif value="{{$category->id}}">{{$category->category_bd}}</option>
                    @if($category->subcategories)
                    @foreach($category->subcategories as $subcategory)
                       <option @if($subcategory->id == $sectionItem->item_id) selected @endif value="{{$subcategory->id}}">-{{$subcategory->category_bd}}</option>
                        @if($subcategory->subcategories)
                        @foreach($subcategory->subcategories as $childcategory)
                        <option @if($childcategory->id == $sectionItem->item_id) selected @endif value="{{$childcategory->id}}">--{{$childcategory->category_bd}}</option>
                        @endforeach
                        @endif
                    @endforeach
                    @endif
               @endforeach
            </select>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label for="name required">Section Layout</label>
            <select required name="section_layout" class="form-control">
                @for($i=1; $i<=12; $i++)
                <option value="alo-{{$i}}"  @if($sectionItem->section_layout == 'alo-'.$i) selected @endif>Alo {{$i}}</option>
                @endfor
                @for($i=1; $i<=1; $i++)
                <option value="ads-{{$i}}"  @if($sectionItem->section_layout == 'ads-'.$i) selected @endif>Ads {{$i}}</option>
                @endfor
                <option value="map"  @if($sectionItem->section_layout == 'map') selected @endif>Map</option>
            </select>
        </div>
    </div>
    
 
    <div class="col-md-3">
        <div class="form-group">
            <label for="background_color">Title BG Color</label>
            <select name="background_color" class="form-control">
                @for($i=1; $i<=5; $i++)
                <option value="title_bg_color-{{$i}}"  @if($sectionItem->background_color == 'title_bg_color-'.$i) selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>
        
        <div class="form-group">
            <label for="borders">Border Color</label>
            <input type="text" name="borders" id="borders" value="{{$sectionItem->borders}}" class="form-control gradient-colorpicker" >
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
            <label for="name">Title Color</label>
            <select name="text_color" class="form-control">
                @for($i=1; $i<=5; $i++)
                <option value="title_text_color-{{$i}}"  @if($sectionItem->text_color == 'title_text_color-'.$i) selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="bg_text">Box BG Color</label>
            <select name="bg_text" class="form-control">
                @for($i=1; $i<=5; $i++)
                <option value="box_bg_color-{{$i}}"  @if($sectionItem->bg_text == 'box_bg_color-'.$i) selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
            <label class="required" for="bt_text">Box Color</label>
            <select name="bt_text" class="form-control">
                @for($i=1; $i<=5; $i++)
                <option value="box_text_color-{{$i}}"  @if($sectionItem->bt_text == 'box_text_color-'.$i) selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="form-group">
            <label class="required">Padding</label>
            <input type="text" value="{{$sectionItem->padding}}" class="form-control" placeholder="Example: 7" name="padding">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="required">Margin</label>
            <input type="text" value="{{$sectionItem->margin}}" class="form-control" placeholder="Example: 7" name="margin">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="required">Number Of Item</label>
            <input type="number" value="{{$sectionItem->item_number}}" class="form-control" placeholder="Example: 7" name="item_number">
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group"> 
            <label class="dropify_image">Title Image</label>
            <input data-default-file="{{asset('upload/images/homepage/'.$sectionItem->title_img)}}" type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="title_img" id="input-file-events">
            <i class="info">Recommended size: any</i>
        </div>
        @if($errors->has('title_img'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('title_img') }}
            </span>
        @endif
    </div>
    <div class="col-md-6">
        <label class="codex">Ads code</label>
        <textarea name="codex" class="form-control" placeholder="Enter details" id="codex" rows="9" value="{{$sectionItem->codex}}">{{$sectionItem->codex}}</textarea>
    </div>
    
    
    <div class="col-md-3">
        <div class="form-group">
            <label for="colmd">Desktop</label>
            <select required name="colmd" class="form-control">
                @for($i=1; $i<=12; $i++)
                <option value="col-md-{{$i}}"  @if($sectionItem->colmd == 'col-md-'.$i) selected @endif>col-md-{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="colxs">Grid</label>
            <select required name="colxs" class="form-control">
                @for($i=1; $i<=12; $i++)
                <option value="{{$i}}" @if($sectionItem->colxs == ''.$i) selected @endif>Grid {{$i}}</option>
                @endfor
                <option value="55" @if($sectionItem->colxs == '55') selected @endif>Grid 55</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="device">Cat / Time</label>
            <select name="device" class="form-control">
                <option value=""  @if($sectionItem->device == '') selected @endif>Off</option>
                <option value="1"  @if($sectionItem->device == '1') selected @endif>On</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="lazyload">Lazyload</label>
            <select required name="lazyload" class="form-control">
                <option value="1" @if($sectionItem->lazyload == '1') selected @endif>On</option>
                <option value="" @if($sectionItem->lazyload == '') selected @endif>Off</option>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label class="switch-box">Status</label>
            <div  class="status-btn" >
                <div class="custom-control custom-switch">
                    <input name="status" {{($sectionItem->status == 1) ?  'checked' : ''}}   type="checkbox" class="custom-control-input" id="status-edit">
                    <label  class="custom-control-label" for="status-edit">Publish/UnPublish</label>
                </div>
            </div>
        </div>
    </div>
</div>
                           