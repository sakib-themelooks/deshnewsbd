<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header flex space-between p-10">
			<h4 class="modal-title m-0" id="myModalLabel"><img src="{{ asset('upload/images/logo/'.config('siteSetting.logo'))}}" height="30" alt="Logo"></h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
		</div>
		<?php 
        $menuitemss = App\Models\Menuitem::with(['subMenus.childMenus'])->whereNull('parent_id')->whereHas('get_menu', function($query){ $query->where('location','top_header');})->orderby('position', 'asc')->get(); 
        ?>
		<div class="modal-body">
			<div id="menu-sidebar" class="modal-body">
				<ul class="list-unstyled p-l-10 bg-w">
				    <li class="p-tb-1 border-bottom"><a href="{{url('/')}}">{{$siteSetting->lang4}}</a></li>
                @foreach($menuitemss as $menuitem)
                    <li class="p-tb-1 border-bottom">
                        <a href="{{ url($menuitem->url) }}">{{$menuitem->title}}</a>
                    </li>
                @endforeach
                </ul>
			</div>
		</div>
	</div>
</div>