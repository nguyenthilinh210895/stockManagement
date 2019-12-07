@extends('layouts.default')
@section('title', 'Input Warehouse')
@section('content')
    <div id="app">
        <input-create-component v-bind:employees="{{$employee}}"></input-create-component> </div>
@endsection
