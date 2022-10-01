<input type="hidden" value="{{$sectionItem->id}}" name="id">
<div class="row">
    <div class="col-md-3">
        <div class="form-group"> 
            <label class="dropify_image">Icon</label>
            <input type="file" class="dropify" accept="image/*" data-type='image' data-default-file="{{asset('upload/images/homepage/'.$sectionItem->banner9)}}" data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner9" id="input-file-events">
            <i class="info">Requirement size: any</i>
        </div>
        @if ($errors->has('banner9'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('banner9') }}
            </span>
        @endif
    </div>
    <div class="col-md-9">
        <div class="form-group">
            <label for="name">Section Title</label>
            <input required placeholder="Enter Title" name="item_title" id="name" value="{{$sectionItem->item_title}}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="sub_title">Sub Title</label>
            <input name="item_sub_title" placeholder="Enter sub title" id="sub_title" value="{{$sectionItem->item_sub_title}}" type="text" class="form-control">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group"> 
            <label class="dropify_image">Image</label>
            <input type="file" class="dropify" accept="image/*" data-type='image' data-default-file="{{asset('upload/images/homepage/'.$sectionItem->banner1)}}" data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner1" id="input-file-events">
            <i class="info">Requirement size: any</i>
        </div>
        @if ($errors->has('banner1'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('banner1') }}
            </span>
        @endif
    </div>
    <div class="col-md-3">
        <div class="form-group"> 
            <label class="dropify_image">Image</label>
            <input type="file" class="dropify" accept="image/*" data-type='image' data-default-file="{{asset('upload/images/homepage/'.$sectionItem->banner2)}}" data-default-file="{{asset('upload/images/homepage/'.$sectionItem->thumb_image)}}" data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner2" id="input-file-events">
            <i class="info">Requirement size: any</i>
        </div>
        @if ($errors->has('banner2'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('banner2') }}
            </span>
        @endif
    </div>
    <div class="col-md-3">
        <div class="form-group"> 
            <label class="dropify_image">Image</label>
            <input type="file" class="dropify" accept="image/*" data-type='image' data-default-file="{{asset('upload/images/homepage/'.$sectionItem->banner3)}}" data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner3" id="input-file-events">
            <i class="info">Requirement size: any</i>
        </div>
        @if ($errors->has('banner3'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('banner3') }}
            </span>
        @endif
    </div>
    <div class="col-md-3">
        <div class="form-group"> 
            <label class="dropify_image">Image</label>
            <input type="file" class="dropify" accept="image/*" data-type='image' data-default-file="{{asset('upload/images/homepage/'.$sectionItem->banner4)}}" data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner4" id="input-file-events">
            <i class="info">Requirement size: any</i>
        </div>
        @if ($errors->has('banner4'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('banner4') }}
            </span>
        @endif
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
            <label for="name1">Title</label>
            <input placeholder="Enter Title" name="name1" id="name1" value="{{$sectionItem->name1}}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="name">Sub Title</label>
            <input name="subname1" placeholder="Enter sub title" id="subname1" value="{{$sectionItem->subname1}}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="link1">Link</label>
            <input name="link1" placeholder="Enter link" class="form-control" value="{{$sectionItem->link1}}">
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
            <label for="name2">Title</label>
            <input placeholder="Enter Title" name="name2" id="name2" value="{{$sectionItem->name2}}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="subname2">Sub Title</label>
            <input name="subname2" placeholder="Enter sub title" id="subname2" value="{{$sectionItem->subname2}}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="link2">Link</label>
            <input name="link2" placeholder="Enter link" class="form-control" value="{{$sectionItem->link2}}">
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
            <label for="name3">Title</label>
            <input placeholder="Enter Title" name="name3" id="name3" value="{{$sectionItem->name3}}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="subname3">Sub Title</label>
            <input name="subname3" placeholder="Enter sub title" id="subname3" value="{{$sectionItem->subname3}}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="link3">Link</label>
            <input name="link3" placeholder="Enter link" class="form-control" value="{{$sectionItem->link3}}">
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
            <label for="name4">Title</label>
            <input placeholder="Enter Title" name="name4" id="name4" value="{{$sectionItem->name4}}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="subname4">Sub Title</label>
            <input name="subname4" placeholder="Enter sub title" id="subname4" value="{{$sectionItem->subname4}}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="link4">Link</label>
            <input name="link4" placeholder="Enter link" class="form-control" value="{{$sectionItem->link4}}">
        </div>
    </div>
    
    
    
    <div class="col-md-3">
        <div class="form-group"> 
            <label class="dropify_image">Image</label>
            <input type="file" class="dropify" accept="image/*" data-type='image' data-default-file="{{asset('upload/images/homepage/'.$sectionItem->banner5)}}" data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner5" id="input-file-events">
            <i class="info">Requirement size: any</i>
        </div>
        @if ($errors->has('banner5'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('banner5') }}
            </span>
        @endif
    </div>
    <div class="col-md-3">
        <div class="form-group"> 
            <label class="dropify_image">Image</label>
            <input type="file" class="dropify" accept="image/*" data-type='image' data-default-file="{{asset('upload/images/homepage/'.$sectionItem->banner6)}}" data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner6" id="input-file-events">
            <i class="info">Requirement size: any</i>
        </div>
        @if ($errors->has('banner6'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('banner6') }}
            </span>
        @endif
    </div>
    <div class="col-md-3">
        <div class="form-group"> 
            <label class="dropify_image">Image</label>
            <input type="file" class="dropify" accept="image/*" data-type='image' data-default-file="{{asset('upload/images/homepage/'.$sectionItem->banner7)}}" data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner7" id="input-file-events">
            <i class="info">Requirement size: any</i>
        </div>
        @if ($errors->has('banner7'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('banner7') }}
            </span>
        @endif
    </div>
    <div class="col-md-3">
        <div class="form-group"> 
            <label class="dropify_image">Image</label>
            <input type="file" class="dropify" accept="image/*" data-type='image' data-default-file="{{asset('upload/images/homepage/'.$sectionItem->banner8)}}" data-allowed-file-extensions="jpg jpeg png gif"  data-max-file-size="10M"  name="banner8" id="input-file-events">
            <i class="info">Requirement size: any</i>
        </div>
        @if ($errors->has('banner8'))
            <span class="invalid-feedback" role="alert">
                {{ $errors->first('banner8') }}
            </span>
        @endif
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
            <label for="name5">Title</label>
            <input placeholder="Enter Title" name="name5" id="name5" value="{{$sectionItem->name5}}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="subname5">Sub Title</label>
            <input name="subname5" placeholder="Enter sub title" id="subname5" value="{{$sectionItem->subname5}}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="link5">Link</label>
            <input name="link5" placeholder="Enter link" class="form-control" value="{{$sectionItem->link5}}">
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
            <label for="name6">Title</label>
            <input placeholder="Enter Title" name="name6" id="name6" value="{{$sectionItem->name6}}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="subname6">Sub Title</label>
            <input name="subname6" placeholder="Enter sub title" id="subname6" value="{{$sectionItem->subname6}}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="link6">Link</label>
            <input name="link6" placeholder="Enter link" class="form-control" value="{{$sectionItem->link6}}">
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
            <label for="name7">Title</label>
            <input placeholder="Enter Title" name="name7" id="name7" value="{{$sectionItem->name7}}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="subname7">Sub Title</label>
            <input name="subname7" placeholder="Enter sub title" id="subname7" value="{{$sectionItem->subname7}}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="link7">Link</label>
            <input name="link7" placeholder="Enter link" class="form-control" value="{{$sectionItem->link7}}">
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="form-group">
            <label for="name8">Title</label>
            <input placeholder="Enter Title" name="name8" id="name8" value="{{$sectionItem->name8}}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="subname8">Sub Title</label>
            <input name="subname8" placeholder="Enter sub title" id="subname8" value="{{$sectionItem->subname8}}" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="link8">Link</label>
            <input name="link8" placeholder="Enter link" class="form-control" value="{{$sectionItem->link8}}">
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            <label class="switch-box">Status</label>
            <div  class="status-btn" >
                <div class="custom-control custom-switch">
                    <input name="status" {{($sectionItem->status == '1') ?  'checked' : ''}}   type="checkbox" class="custom-control-input" id="status-edit">
                    <label  class="custom-control-label" for="status-edit">Publish/UnPublish</label>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
                           