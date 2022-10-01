@php
    function getArea($id=null,$is_for_upozilla = false){
        if($id == null){
            return \DB::table('deshjures')->where('cat_type','=','division')->select(['id','name_bd','name_en'])->get();
        }
        else{
            if(!$is_for_upozilla){
                return \DB::table('deshjures')
                ->where('cat_type','=','district')
                ->where('parent_id','=',1)
                ->select(['id','name_bd','name_en'])->get();
            }
            else{
                return \DB::table('deshjures')->where('cat_type','=','upzilla')->where('parent_id','=',(int)$id)->select(['id','name_bd','name_en'])->get();
            }
        }
    }
    
    $divisions =getArea();
@endphp
<div class="{{$section_item->colmd}} col-xs-12 pps">
    @include(('frontend.pages.layouts.title').$section_item->item_title_number)
    <div class="col-md-12 col-xs-12">
        <div class="homePageSideSvg">
            <form action="{{route('location')}}" method="get">
                <div>    
                    <div class="form-group">    
                        <select name="division" class="form-control custom-select" id="bivag" onChange="getZilla()">
                            <option value="">Division</option>
                            @foreach($divisions as $division)
                    		    <option value="{{$division->id}}">{{$division->name_bd}}</option>
                    		@endforeach
                    	</select>
                	</div>
            	</div>
            	<div id="zilla_div">
            	    <div class="form-group"> 
                    	<select name="zilla" class="form-control custom-select" id="zilla">
                    	    <option value="">All</option>
                    	</select>
                	</div>
            	</div>
            	<div id="upozilla_div">
            	    <div class="form-group"> 
                    	<select name="upazilla" class="form-control select2" id="upozilla">
                    		<option value="">All</option>
                    	</select>
                	</div>
            	</div>
            	<button type="submit" class="btn btn-success">Search</button>
        	</form>
        </div>
    </div>
</div>