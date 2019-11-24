@extends('layouts.default')
@section('title', 'Product')
@section('content')
<div id="app">
    <create-product-component v-bind:zone="{{$zone}}" v-bind:manufacturer="{{$manufacturer}}"
    v-bind:calculation_unit="{{ $calculation_unit}}" v-bind:item_group="{{ $item_group}}"
    v-bind:quality="{{$quality}}">

    </create-product-component> </div>
@endsection
