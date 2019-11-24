@extends('layouts.default')
@section('title', 'Profile')
@section('content')
    <div id="app" ><user-profile-component v-bind:user="{{$user}}"></user-profile-component> </div>
@endsection
