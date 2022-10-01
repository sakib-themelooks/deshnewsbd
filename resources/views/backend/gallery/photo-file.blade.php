<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>File manager</title>
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/bootstrap.min.css') }}" media="screen">
	<style type="text/css">
		.gallery-card{width: 100px; float:left ; cursor: pointer;margin: 3px; padding: 3px; border: 1px solid #dff0ff;}
		.title{height: 35px;overflow: hidden;}
	</style>
</head>
<body>
<div id="fileExplorer">
@foreach($fileNames as $fileName)
    <div class="gallery-card">
        <div class="gallery-card-body">
            <img src="{{asset('upload/images/news/'.$fileName->source_path)}}" width="100" height="90" title="{{$fileName->source_path}}" />
           	<p class="title">{{Str::limit($fileName->source_path, 15)}}</p>
        </div>
    </div>  
@endforeach

</div>
<div>{{$fileNames->appends(request()->query())->links()}}</div>
<script src="{{asset('backend/assets/node_modules/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>

<script type="text/javascript">
	var function_number = {{$_GET['CKEditorFuncNum']}};
	$('#fileExplorer').on('click', 'img', function(){
	
	var  fileUrl = $(this).attr('src');
	window.opener.CKEDITOR.tools.callFunction(function_number, fileUrl);
	window.close();
}).hover(function(){
	$(this).css('cursor', 'pointer');
});
</script>
</body>
</html>