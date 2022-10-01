<script src="{{ mix('backend/js/app.js') }}"></script>
<script src="{{ asset('backend/js/custom.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

@yield('js')
@yield('perpage-js')
<script type="text/javascript">
    //change status by id
    function satusActiveDeactive(table, id, field = null){
        var  url = '{{route("statusChange")}}';
        $.ajax({
            url:url,
            method:"get",
            data:{table:table,field:field,id:id},
            success:function(data){
                if(data.status){
                    toastr.success(data.message);
                }else{
                    toastr.error(data.message);
                }
            }
        });
    }
</script>

<script type="text/javascript">
    function deleteConfirmPopup(route, item='') {
        $('#deleteModal').modal('show');
        document.getElementById('deleteItemRoute').value = route;
        //hide delete item
        document.getElementById('item').value = item;
    }

    function deleteItem(route) {
        //separate id from route
        var id = route.split("/").pop();
        var item = $('#item').val();
        $.ajax({
            url:route,
            method:"get",
            success:function(data){
                if(data.status){
                    $("#item"+item+id).remove();
                    toastr.success(data.msg);
                }else{
                    toastr.error(data.msg);
                }
            }

        });
    }

    // delete product feature detail
    function deleteDataCommon(table,id, field=''){
        if(confirm('Are you sure delete.?')) {
            var route = '{{ route("deleteDataCommon") }}';
            route = route.replace(":id", id);
            $.ajax({
                url:route,
                method:"get",
                data:{table:table,id:id,field:field},
                success:function(data){
                    if(data.status){
                        $("#"+table+id).remove();
                        toastr.success(data.msg);
                    }else{
                        toastr.error(data.msg);
                    }
                }
            });
         }else{
            return false;
        }
    }
</script>

<script type="text/javascript">
    //change status by id
    function approveUnapprove(table, id, field = null){
        var  url = '{{route("approveUnapprove")}}';
        $.ajax({
            url:url,
            method:"get",
            data:{table:table,field:field,id:id},
            success:function(data){
                if(data.status){
                    toastr.success(data.message);
                }else{
                    toastr.error(data.message);
                }
            }
        });
    }
</script>


{!! Toastr::message() !!}
<script>
    @if($errors->any())
        
        @if(Session::get('submitType'))
            // if occur error open model
            $("#{{Session::get('submitType')}}").modal('show');
            //open edit modal by id
            @if(Session::get('submitType')=='edit')
                edit({{old('id')}});
            @endif
        @endif

        @foreach($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif
</script>

<script>
    $(document).ready(function(){
        $( "#positionSorting" ).sortable({
            placeholder : "ui-state-highlight",
            update  : function(event, ui)
            {
                var ids = new Array();
                $('#positionSorting tr').each(function(){
                    ids.push($(this).attr("id"));
                });
                var table = $(this).attr('data-table');

                $.ajax({
                    url:"{{route('positionSorting')}}",
                    method:"get",
                    data:{ids:ids,table:table},
                    success:function(data){
                        toastr.success(data)
                    }
                });
            }
        });
    });
</script>

@if(Auth::check())
<script>
    function readNotify(id){
        
        var url = "{{route('readNotify', ':id')}}";
        url = url.replace(":id", id);
        $.ajax({
            url:url,
            method:"get",
        });
    }

</script>

<script type="text/javascript">
    $(document).ready(function(){
            // Prepare the preview for profile picture
                $("#wizard-picture").change(function(){
                    readURL(this);
                });
            });
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
</script>
@endif

<!--     <script>
    
    Echo.channel('postBroadcast')
    .listen('PostCreated', (e) => {
        toastr.info(e.post['title']);
    });
</script> -->