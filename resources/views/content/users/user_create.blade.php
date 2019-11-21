
@extends('layouts.default')
@section('title', 'Create User')
@section('content')
    <div id="app" ><user-create-component v-bind:warehouses="{{$warehouse}}"></user-create-component> </div>
@endsection
