<input type="hidden" value="{{$section->id}}" name="id">

<div class="row">
    <div class="col-md-9">
        <div class="form-group">
            <label class="required" for="name">Section Title</label>
            <input  name="title" id="name" value="{{$section->title}}" type="text" class="form-control">
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
            <label for="display">Display</label>
            <select name="display" class="form-control">
                <option @if($section->display == 'block') selected @endif value="block">on</option>
                
                <option @if($section->display == 'none') selected @endif value="none">off</option>
            </select>
        </div>
    </div>
    
    @if($section->is_default != 1)
    <div class="col-md-12">
        <div class="form-group">
            <label for="name required">Select Sourch</label>
            <select required onchange="sectionType(this.value, 'edit')" name="section_type" class="form-control">
                <option value="">Selct one</option>
                <option  @if($section->section_type == 'services') selected @endif value="section">Services</option>
                <option  @if($section->section_type == 'category-product') selected @endif value="category-product"> Category Product</option>
                <option  @if($section->section_type == 'category') selected @endif value="category">Categories</option>
                <option @if($section->section_type == 'banner') selected @endif value="banner">Banner</option>
                
                <option @if(preg_replace("/\d/", "", $section->section_type) == 'special-item') selected @endif value="special-item">Special Item</option>
               
            </select>
        </div>

    </div>
    <div class="col-md-12">
        <div class="row" id="editshowSection"> 
        @if($section->section_type == 'banner')
            <div class="col-md-12"><div class="form-group"> <label class="required" for="product_id">Select Banner</label> <select name="product_id" required="required" id="product_id" class="form-control custom-select"> <option value="">Select banner</option>@foreach($banners as $banner)<option @if($section->product_id == $banner->id) selected @endif value="{{$banner->id}}" > {{$banner->title}}</option>@endforeach</select> </div></div>
        @elseif($section->section_type == 'services')
            <div class="col-md-12"><div class="form-group"> <label class="required" for="product_id">Services</label> <select name="product_id" required="required" id="product_id" class="form-control select2" custom-select"><option value="">Select service</option> @foreach($serviceTypes as $serviceType)  <option value="{{$serviceType->id}}" @if($section->product_id == $serviceType->id) selected @endif>{{$serviceType->title}}</option>  @endforeach</select> </div></div>

        }
        @elseif($section->section_type== 'category')
            <div class="col-md-12"><div class="form-group"> <label class="required" for="product_id"> Categories</label> <select name="product_id" id="product_id" class="form-control select2 custom-select"> <option value="">Select category</option>@foreach($categories as $category) <option  @if($section->product_id == $category->id) selected @endif value="{{$category->id}}">{{$category->category_bd}}</option> <!-- get subcategory --> @if(count($category->subcategory)>0) @foreach($category->subcategory as $subcategory)  <option  @if($section->product_id == $subcategory->id) selected @endif value="{{$subcategory->id}}">&nbsp; -{{$subcategory->subcategory_bd}}</option>  <!-- end subcategory --> @endforeach  @endif <!-- end subcategory --> @endforeach</select> </div></div>

        @elseif(preg_replace("/\d/", "", $section->section_type) == 'special-item')
            <div class="col-md-12"><div class="form-group"> <label class="required" for="special_item">Select special item</label> <select name="special_item" required="required" id="special_item" class="form-control select2" custom-select"><option @if($section->section_type == 'special-item') selected @endif value="special-item">Select item</option> @for($i=1; $i<=11; $i++)  <option @if($section->section_type == 'special-item'.$i) selected @endif value="special-item{{$i}}">Special Item {{$i}}</option>  @endfor</select> </div></div>

        @else

       @endif
        </div>
    </div>
    @endif

    <div class="col-md-6">
        <div class="form-group">
            <label class="required">Number Of Item</label>
            <input type="number" min="1" value="{{$section->item_number}}" class="form-control" placeholder="Example: 7" name="item_number">
        </div>
    </div>    
    @if($section->section_type == 'recent-views')
    <div class="col-md-6">
        <div class="form-group">
            <label class="required">Number Of Section</label>
            <input type="number" min="1" value="{{$section->section_number}}" class="form-control" placeholder="Example: 3" name="section_number">
        </div>
    </div>
    @endif
    <div class="col-md-6">
        <div class="form-group">
            <label class="required">Section Width</label>
            <select name="layout_width" class="form-control">
                <option @if($section->layout_width == null) selected @endif value="box">Box</option>
                <option @if($section->layout_width != null) selected @endif value="full">Full</option>
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="required" for="name">Bacground Color</label>
            <input name="background_color" value="{{$section->background_color}}" class="form-control gradient-colorpicker">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="required" for="name">Text Color</label>
            <input name="text_color" value="{{$section->text_color}}" class="form-control gradient-colorpicker">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="text_bg">Text Bacground Color</label>
            <input name="text_bg" value="{{$section->text_bg}}" class="form-control gradient-colorpicker">
        </div>
    </div>
    

    <div class="col-md-12">
        <div class="form-group"> 
            <label class="dropify_image">Tumbnail Image </label>
            <div class="thumb_image">
            @if($section->thumb_image)
            <span style="color:red;float: right;cursor: pointer;" onclick="removeImage('{{$section->id}}')">Delete Image</span>@endif
            <input data-default-file="{{asset('upload/images/homepage/'.$section->thumb_image)}}" type="file" class="dropify" accept="image/*" data-type='image' data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="thumb_image" id="input-file-events">
            </div>
            <i class="update-info">Recommended size: 300px*250px</i>
        </div>
        @if($errors->has('thumb_image'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('thumb_image') }}
            </span>
        @endif
    </div>
   
    <div class="col-md-12">
        <div class="form-group">
            <label for="name">Image Position</label>
            <select name="image_position" class="form-control">
                <option @if($section->image_position == 'left') selected @endif value="left">Left</option>
                
                <option @if($section->image_position == 'right') selected @endif value="right">Right</option>
            </select>
        </div>
    </div>

    
    
</div>
                         
<div class="col-md-12">

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

