<input type="hidden" value="{{$sectionItem->id}}" name="id">

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="item_title">Section Title</label>
            <input placeholder="Enter Title" name="item_title" id="item_title" value="{{$sectionItem->item_title}}" type="text" class="form-control">
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
            <select multiple required name="category_id[]" id="category_id" class="selectpicker form-control custom-select">
               
               @foreach($categories as $category)
               <option @if(in_array($category->id, json_decode($sectionItem->item_id))) selected @endif value="{{$category->id}}">{{$category->category_bd}}</option>

                    @foreach($category->subcategory as $subcategory)
                    <option @if(in_array($subcategory->id, json_decode($sectionItem->item_id))) selected @endif value="{{$subcategory->id}}">--{{$subcategory->category_bd}}</option>
                       
                        @foreach($subcategory->subcategories as $childcategory)
                        <option @if(in_array($childcategory->id, json_decode($sectionItem->item_id))) selected @endif value="{{$childcategory->id}}">--{{$childcategory->category_bd}}</option>
                        @endforeach
                   
                    @endforeach
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
            </select>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
            <label class="required" for="background_color">Title BG Color</label>
            <input type="text" name="background_color" id="background_color" value="{{$sectionItem->background_color}}" class="form-control gradient-colorpicker" >
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
            <label class="required" for="name">Title Color</label>
            <input name="text_color" value="{{$sectionItem->text_color}}" class="gradient-colorpicker form-control" >
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="required" for="bg_text">Box BG Color</label>
            <input type="text" name="bg_text" id="bg_text" value="{{$sectionItem->bg_text}}" class="form-control gradient-colorpicker" >
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
            <label class="required" for="bt_text">Box Color</label>
            <input name="bt_text" id="bt_text" value="{{$sectionItem->bt_text}}" class="gradient-colorpicker form-control" >
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
                <option value="{{$i}}"  @if($sectionItem->colxs == ''.$i) selected @endif>Grid {{$i}}</option>
                @endfor
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
                <option value="on"  @if($sectionItem->lazyload == 'on') selected @endif>On</option>
                <option value=""  @if($sectionItem->lazyload == '') selected @endif>Off</option>
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
                           