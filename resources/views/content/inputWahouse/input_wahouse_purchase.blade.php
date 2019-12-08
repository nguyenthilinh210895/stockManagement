@extends('layouts.default')
@section('title', 'Input Warehouse')
@section('content')
    <div id="app">
        <input-purchase-component v-bind:input_id="{{$input_id}}"></input-purchase-component> </div>
@endsection
