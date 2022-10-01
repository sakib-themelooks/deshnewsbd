<div class="{{$section_item->colmd}} col-xs-12">
    @if(Request::is('/'))
        @php $poll = App\Models\Poll::with(['pollOptions'])->where('status', 1)->orderBy('position', 'asc')->whereDate('start_date', '<=', Carbon\Carbon::now())->whereDate('end_date', '>=', Carbon\Carbon::now())->first(); @endphp
        @if($poll)
        <div class="col-md-12 pps mms">
            <div class="news-title col-md-12 pps flex"><h1 class="box_text_color-1">{{$section_item->item_title}}</h1><i style="font-size:25px;color: red;font-weight: bold;padding-left: 10px;" class="fa fa-angle-right" aria-hidden="true"></i></div>
            <div style="background: {!! $poll->bg_color !!}; color: {!! $poll->text_color !!}; margin:0; padding:0;">
                <form action="{{url('/')}}" method="get" id="polling">
                    <input type="hidden" name="poll_id" value="{{$poll->id}}">
                    <div style="font-size: 18px;">{!! $poll->poll_details !!}</div>
                  
                    @if(count($poll->pollOptions)>0)
                        @php $total_votes =  $poll->pollOptions->sum('votes'); @endphp
                        @foreach($poll->pollOptions as $pollOption)
                        @php 
                        $percent = ($total_votes > 0) ? round(($pollOption->votes/$total_votes)  * 100, 2) : 0;
                        @endphp
                            <div class="progress" style="position:relative;">
                              <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50"
                              aria-valuemin="0" aria-valuemax="100" style="width:{{ $percent }}%">
                                <label style="position:absolute;top: 0;left: 5px; color: {!! $poll->text_color !!}" for="option{{$pollOption->id}}">
                                <input required type="radio" value="{{$pollOption->id}}" name="pollOption" id="option{{$pollOption->id}}"> {{$pollOption->option}} </label><span style="position: absolute;top: 0;right:5px;color: {!! $poll->text_color !!};">{{ $percent }}%</span>
                              </div>
                            </div>
                        @endforeach
                        <p><button class="btn btn-success" style="background: #144c66;border: #144c66;width: 100%;color:#fff;">Vote now</button></p>
                    @endif
                </form>
            </div>
        </div>
        @endif
    @endif
    <div class="col-md-12 col-xs-12">{!! $section_item->codex !!}</div>
</div>
<style>
.progress {
    height: 20px;
    margin-bottom: 20px;
    overflow: hidden;
    background-color: #f5f5f5;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
    box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
}
.progress-bar-info {
    background-color: #5bc0de;
}
.progress-bar {
    float: left;
    width: 0;
    height: 100%;
    font-size: 12px;
    line-height: 20px;
    color: #fff;
    text-align: center;
    background-color: #337ab7;
    -webkit-box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
    -webkit-transition: width .6s ease;
    -o-transition: width .6s ease;
    transition: width .6s ease;
}
</style>
