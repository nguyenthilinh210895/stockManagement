@extends('layouts.default')
@section('title', 'Input Warehouse')
@section('content')
    <div id="app">
        <input-edit-component v-bind:input_id="{{$input_id}}"  v-bind:employees="{{$employee}}"
                              v-bind:zones="{{$zones}}"
            ></input-edit-component></div>
@endsection
