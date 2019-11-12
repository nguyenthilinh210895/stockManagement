
@extends('layouts.default')
@section('title', 'Page Warehouse')
@section('content')
<div id="app" ><warehouse-create-component v-bind:area="{{$area}}"></warehouse-create-component> </div>
@endsection