@extends('layouts.default')
@section('title', 'Input Warehouse')
@section('content')
    <div id="app">
        <input-create-component v-bind:employees="{{$employee}}" v-bind:zones="{{$zones}}"></input-create-component> </div>
@endsection
