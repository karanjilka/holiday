<h1>Events</h1>
@foreach($rows as $row)
<div>
<a href="{{url('/hoiday-detail')}}">{{$row->name}}</a>
<em>{{date('d-m-Y',strtotime($row->start_date))}}</em>
@if(!empty($row->end_date))
To <em>{{date('d-m-Y',strtotime($row->end_date))}}</em>
@endif
<img src="{{url('/uploads/events/'.$row->image)}}" />
<div>
	{{$row->summary}}
</div>
</div>
@endforeach

<a href="{{url('/change-your-preference/'.Crypt::encryptString($subscriber->id))}}">Change your preference</a>