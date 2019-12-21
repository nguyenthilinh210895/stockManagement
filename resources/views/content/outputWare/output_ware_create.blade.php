@extends('layouts.default')
@section('title', 'Input Warehouse')
@section('content')
    <div id="app">
        <output-create-component v-bind:employees="{{$employee}}"></output-create-component> </div>
@endsection
