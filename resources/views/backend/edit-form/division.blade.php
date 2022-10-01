
<input type="hidden" value="{{$data->id}}" name="id">


<div class="col-md-12">
    <div class="form-group">
        <label for="name_bd">Name</label>
        <input  name="name_bd" id="name_bd" value="{{$data->name_bd}}" required="" type="text" class="form-control">
    </div>
</div>
<!-- <div class="col-md-12">
    <div class="form-group">
        <label for="name_en">English Name</label>
        <input  name="name_en" id="name_en" value="{{$data->name_en}}" required="" type="text" class="form-control">
    </div>
</div> -->


<div class="col-md-12 mb-12">

    <div class="head-label">
        <label class="switch-box">Status</label>
        <div  class="status-btn" >
            <div class="custom-control custom-switch">
                <input name="status" {{($data->status == 1) ?  'checked' : ''}}   type="checkbox" class="custom-control-input" id="status-edit">
                <label style="padding: 8px 15px;"  class="custom-control-label" for="status-edit">Publish/UnPublish</label>
            </div>
        </div>
    </div>

</div>

