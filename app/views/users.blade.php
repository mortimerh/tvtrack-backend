@extends('layout')

@section('content')
    @foreach($users as $user)
    	<p>{{ $user->name }} has email {{$user->email}} and password {{$user->password}}</p>
  	@endforeach
@stop