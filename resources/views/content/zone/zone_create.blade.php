
@extends('layouts.default')
@section('title', 'Page Zone')
@section('content')
    <div id="app" ><zone-create-component v-bind:warehouse="{{$warehouse}}"></zone-create-component> </div>
@endsection
