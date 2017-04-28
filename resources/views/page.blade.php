@extends('layouts.master')
@section('title', 'Page title')

@section('sidebar')
    @parent <!-- this includes the content from the extended layout -->
        <p>This is appended to the master sidebar</p>
@endsection

@section('content')
    <h2>{{$name}}</h2>
    <h3>{{$data}}</h3>
    <p>This is my body content</p>
@endsection
