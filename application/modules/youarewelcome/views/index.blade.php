@extends('master')

@section('title', 'Codeigniter 3 y Blade')

@section('sidebar')
    @parent

    <p>Sidebar.</p>
@endsection

@section('content')
    <p>Hola {{ $name }}</p>
    @if(sizeof($users) > 0)
        @foreach($users as $user)
            <p>{{ $user }}</p>
        @endforeach
    @endif

    Application Key: {{ $session_key }}
@endsection