@extends('layouts.default')
@section('title', 'Page Item')
@section('content')
    <div id="app" ><item-edit-component v-bind:zone="{{$zone}}" v-bind:group_id="{{$group_id}}"></item-edit-component> </div>
@endsection
