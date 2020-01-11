
@extends('layouts.default')
@section('title', 'Home')
@section('content')
<div id="app"><index-component v-bind:usercount="{{$user}}"
            v-bind:inputcount="{{$inputWarehouse}}"
            v-bind:outputcount="{{$outputWare}}" v-bind:productstock="{{ $product_stock}}">
            </index-component>
</div>

@endsection
