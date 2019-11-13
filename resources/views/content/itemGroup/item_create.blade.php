@extends('layouts.default')
@section('title', 'Page Item')
@section('content')
    <div id="app" ><item-create-component v-bind:zone="{{$zone}}"></item-create-component> </div>
@endsection
