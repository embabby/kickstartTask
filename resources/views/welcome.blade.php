@extends('layouts.master')

@section('body')

<div style="overflow: hidden;">
	
<div class="row">
	
 <div id="map" class="col-md-6" style="height: 450px; margin-top: 10px; display: inline-block;"> 

</div>

	<div class="col-md-4" style="margin-top: 10px; display: inline-block;">
		<p><span> Neutral:</span> <img src="{{asset('images/Neutral.png')}}"></p>
		<p><span> Positive:</span> <img src="{{asset('images/Positive.png')}}"></p>
		<p><span> Negative:</span> <img src="{{asset('images/Negative.png')}}"></p>
		<small>*hover on each flag to read the message and the date*</small>
	</div>
</div>
</div>

@stop



