@extends('layouts.default')
@section('title', 'Page Area')
@section('content')
    <div id="app" ><area-edit-component v-bind:area_id="{{$area_id}}"></area-edit-component> </div>
@endsection
