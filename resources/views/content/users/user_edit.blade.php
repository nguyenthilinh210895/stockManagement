@extends('layouts.default')
@section('title', 'Page Item')
@section('content')
    <div id="app"><user-edit-component v-bind:user_id="{{$user_id}}" v-bind:warehouses="{{$warehouse}}"></user-edit-component> </div>
@endsection
