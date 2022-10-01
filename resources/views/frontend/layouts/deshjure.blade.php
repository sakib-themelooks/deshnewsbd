<?php   $divisions = App\Models\Deshjure::where('type', 'division')->get(); ?>
    <form action="{{route('category', ['deshjure'])}}" method="get">
        <div class="row">
            <div class="col-md-12 col-xs-12 mmb">
                <select name="division" required onchange="get_district(this.value)" id="division" class="form-control custom-select">
                    <option value="">{{__('lang.division')}}</option>
                    @foreach($divisions as $division)
                        <option value="{{$division->slug}}">{{$division->name_bd}}</option>
                    @endforeach
                </select>
            </div>
           
            <div class="col-md-12 col-xs-12">
                <span id="getdistrict">
                    <div class="form-group">
                       <select required onchange="get_upzilla(this.value)" name="district" id="district" class="form-control custom-select">
                            <option selected value="">{{__('lang.zilla')}}</option>'
                        </select>
                    </div>
                </span>
            </div>
            <div class="col-md-12 col-xs-12">
                <span id="getupzilla">
                    <div class="form-group">
                       <select name="upzilla" id="upzilla" class="form-control custom-select">
                            <option selected value="">{{__('lang.upzilla')}}</option>'
                        </select>
                    </div>
                </span>
            </div>
        
            <div class="col-md-12 col-xs-12">
                <button type="submit" class="btn btn-danger btn-block">Search now <i class="fa fa-search" aria-hidden="true"></i></button>
            </div>
        </div>
    </form>

    <script type="text/javascript">

    function get_district(id=0){
        var  url = '{{route("deshjure_district", ":id")}}';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#getdistrict").html(data);
                    $("#district").focus();
                    document.getElementById('upzilla').innerHTML = "";
                }else{
                    document.getElementById('district').innerHTML = "";
                    document.getElementById('upzilla').innerHTML = "";
                }
            }
        });
    }

    function get_upzilla(id=0){
        var  url = '{{route("deshjure_upzilla", ":id")}}';
        url = url.replace(':id',id);
        $.ajax({
            url:url,
            method:"get",
            success:function(data){
                if(data){
                    $("#getupzilla").html(data);
                     $("#upzilla").focus();
                }else{
                    $("#upzilla").html('');
                }
            }
        });
    }


</script>

