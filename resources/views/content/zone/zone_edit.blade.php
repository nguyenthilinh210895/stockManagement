
@extends('layouts.default')
@section('title', 'Page Zone')
@section('content')
    <div id="app" ><zone-edit-component v-bind:warehouse="{{$warehouse}}" v-bind:zone_id="{{$zone_id}}"></zone-edit-component> </div>
@endsection
