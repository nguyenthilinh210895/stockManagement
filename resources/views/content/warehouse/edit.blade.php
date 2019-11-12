
@extends('layouts.default')
@section('title', 'Page Warehouse')
@section('content')
    <div id="app" ><warehouse-edit-component v-bind:warehouse_id="{{$warehouse_id}}" v-bind:area="{{$area}}"></warehouse-edit-component> </div>
@endsection
