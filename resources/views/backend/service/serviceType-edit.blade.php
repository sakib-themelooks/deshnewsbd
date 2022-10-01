<input type="hidden" value="{{$data->id}}" name="id">


<div class="col-md-12">
    <div class="form-group">
        <label for="bangla">Service Name</label>
        <input  name="title" id="bangla" value="{{$data->title}}" required="" type="text" class="form-control">
    </div>
</div>
<div class="col-md-12 mb-12">

<div class="head-label">
    <label class="switch-box">Status</label>
    <div  style="status-btn" >
        <div class="custom-control custom-switch">
            <input name="status" {{($data->status == 1) ?  'checked' : ''}}   type="checkbox" class="custom-control-input" id="editstatus">
            <label style="padding: 8px 15px;"  class="custom-control-label" for="editstatus">Publish/UnPublish</label>
        </div>
    </div>
</div>

</div>