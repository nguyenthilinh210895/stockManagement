@extends('layouts.default')
@section('title', 'Page company')
@section('content')
    <div id="app"><manu-edit-component v-bind:manu_id="{{$manu_id}}"></manu-edit-component> </div>
@endsection
