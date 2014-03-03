@extends('layout')

@section('content')
    <h1>Login</h1>

    @if (Session::has('flash_error'))
        <div id="flash_error">{{ Session::get('flash_error') }}</div>
    @endif
    @if (Session::has('hash'))
        <p>Hash was: {{Session::get('hash')}}</p>
    @endif

    {{ Form::open( array('route' => 'login', 'method' => 'POST') ) }}

    <p>
        {{ Form::label('email', 'Email') }}<br/>
        {{ Form::text('email', Input::old('email')) }}
    </p>

    <p>
        {{ Form::label('password', 'Password') }}<br/>
        {{ Form::password('password') }}
    </p>

    <p>{{ Form::submit('Login') }}</p>

    {{ Form::close() }}
@stop