@extends('layouts.default')
@section('title', 'Output Warehouse')
@section('content')
    <div id="app">
        <output-checklist-component v-bind:output_id="{{$output_id}}"></output-checklist-component> </div>
@endsection

