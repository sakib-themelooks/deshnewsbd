<style type="text/css">
	.form-field{padding: 5px;}
	.form-field input{margin: 3px;}
</style>

<section style="margin: 5px 0; @if($section->layout_width == 1) background:{{$section->background_color}} @endif">
  <div class="container" @if($section->layout_width != 1) style="background:{{$section->background_color}};border-radius: 5px;" @endif>
     
      <div class="row">
          @if($section->thumb_image && $section->image_position == 'left')
          <div class="col-md-6 col-xs-12">
          	<h4 style="color:{{$section->text_color}};text-align: center;">{{$section->title}}</h4>
         
            <div style="background: #fff;padding: 5px">
              <img style="width: 100%;height: 100%;" src="{{ asset('upload/images/homepage/'.$section->thumb_image) }}">
            </div>
          </div>
          @endif
          <div class="col-xs-12 col-md-{{($section->thumb_image) ? 6 : 12}}">
          	<form action="{{route('serviceQuery')}}" method="post" enctype="multipart/form-data">
          		@csrf
          		<input type="hidden" name="service_id" value="{{ $service_id }}">
          		<h3>Get your free quote now!</h3>
				<p>Fill out this form, and we’ll get back to you in 12 hours or less with your customized quote.</p>
              <div class="row">
              	
              	<div class="col-md-12">
              		<label>Name</label>
              		<div class="form-group">
              		<input type="text" name="name" class="form-control">
              		</div>
              	</div>

              	<div class="col-md-6">
              		<label>Email</label>
              		<div class="form-group">
              		<input type="email" name="email" class="form-control">
              		</div>
              	</div>

              	<div class="col-md-6">
              		<label>Mobile</label>
              		<div class="form-group">
              		<input type="text" name="mobile" class="form-control">
              		</div>
              	</div>

              	<div class="col-md-12">
              		<label>Quantity</label>
              		<div class="form-group">
              		<input type="number" name="quantity" class="form-control">
              		</div>
              	</div>

              	<div class="col-md-12">
              		<label>Format</label>
              		<div class="form-group">
              		<label class="form-field"><input type="radio" value="jpg" name="radio[]" > JPG </label>
              		<label class="form-field"><input type="radio" value="png" name="radio[]" > PNG </label>
              		<label class="form-field"><input type="radio" value="psd" name="radio[]" > PSD </label>
              		<label class="form-field"><input type="radio" value="tiff" name="radio[]" > TIFF </label>
              		</div>
              	</div>

              	<div class="col-md-12">
              		<label>Checkbox</label>
              		<div class="form-group">
              		<label class="form-field"><input type="checkbox" value="jpg" name="checkbox[]" > JPG </label>
              		<label class="form-field"><input type="checkbox" value="png" name="checkbox[]" > PNG </label>
              		<label class="form-field"><input type="checkbox" value="psd" name="checkbox[]" > PSD </label>
              		<label class="form-field"><input type="checkbox" value="tiff" name="checkbox[]" > TIFF </label>
              		</div>
              	</div>

              	<div class="col-md-12">
              		<label>Dropdown</label>
              		<div class="form-group">
              		<select name="dropdown[]" class="form-control">
              			<option value="">Select one</option>
              			<option value="jpg">JPG</option>
              			<option value="png">PNG</option>
              			<option value="psd">PSD</option>
              			<option value="tiff">TIFF</option>
              		</select>
              		</div>
              	</div>

              	<div class="col-md-12">
              		<label>Upload file</label>
              		<div class="form-group">
              		<input type="file" name="image" class="form-control">
              		</div>
              	</div>

              	<div class="col-md-12">
              		<label>Description</label>
              		<div class="form-group">
              		<textarea name="description" rows="3" class="form-control"></textarea>
              		</div>
              	</div>
              	<div class="col-md-12"><button type="submit" class="form-control btn btn-info">Send</button></div>

              </div>
          	</form>
          </div>
          @if($section->thumb_image && $section->image_position == 'right')
          <div class="col-md-6 col-xs-12">
          	<h4 style="color:{{$section->text_color}};text-align: center;">{{$section->title}}</h4>
         
            <div style="background: #fff;padding: 5px">
              <img style="width: 100%;height: 100%;" src="{{ asset('upload/images/homepage/'.$section->thumb_image) }}">
            </div>
          </div>
          @endif
      </div>
    </div>
</section>
