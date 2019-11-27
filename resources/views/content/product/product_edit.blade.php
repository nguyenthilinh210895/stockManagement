@extends('layouts.default')
@section('title', 'Product')
@section('content')
    <div id="app"><product-edit-component
            v-bind:product_id="{{$product_id}}" v-bind:zone="{{$zone}}" v-bind:manufacturer="{{$manufacturer}}"
                                          v-bind:calculation_unit="{{ $calculation_unit}}" v-bind:item_group="{{ $item_group}}"
                                          v-bind:quality="{{$quality}}"></product-edit-component> </div>
@endsection
