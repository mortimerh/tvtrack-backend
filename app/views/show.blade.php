@extends('layout')

@section('content')
	<h2>{{$show->name}}</h2>
	<ul>
		<li>Status: {{$show->meta->status}}</li>
		<li>Start date: {{$show->meta->start_date}}</li>
		<li>End date: {{$show->meta->end_date}}</li>
		<li>Country: {{$show->meta->origin_country}}</li>
	</ul>
	<h4>Episodes</h4>
	<ul>
		@foreach ($show->episodes as $episode)
			<li>{{$episode->name}} (S{{sprintf('%02d', $episode->season_no)}}E{{sprintf('%02d', $episode->episode_no)}})</li>
		@endforeach
	</ul>

	<h4>Seasons</h4>
	{{$show->seasons()}}

@stop