<div class="card-body inbox-panel"><a href="{{route('reporter.workingTaskCreate')}}" class="btn btn-danger m-b-20 p-10 btn-block waves-effect waves-light">Write New Task</a>
    <ul class="list-group list-group-full">
        <li class="list-group-item @if(Request::segment(3)  == 'inbox') active @endif"> <a href="{{route('reporter.workingTask', 'inbox')}}"><i class="mdi mdi-gmail"></i> Inbox </a>
        </li>
        <li class="list-group-item @if(Request::segment(3) == 'send') active @endif">
            <a href="{{route('reporter.workingTask', 'send')}}"> <i class="mdi mdi-file-document-box"></i> Sent </a>
        </li>
      
        <li class="list-group-item @if(Request::segment(3) == 'scheduled') active @endif">
            <a href="{{route('reporter.workingTask', 'scheduled')}}"> <i class="mdi mdi-clock"></i> Scheduled </a>
        </li>
        <li class="list-group-item @if(Request::segment(3)  == 'all') active @endif">
            <a href="{{route('reporter.workingTask', 'all')}}"> <i class="mdi mdi-label"></i> All Task </a>
        </li><li class="list-group-item">
            <a href="javascript:void(0)"> <i class="mdi mdi-delete"></i> Trash </a>
        </li>
    </ul>
</div>