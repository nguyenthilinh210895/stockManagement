@extends('layouts.default')
@section('title', 'Profile')
@section('content')
    <div id="app" ><user-profile-component v-bind:users="{{$users}}"></user-profile-component> </div>
@endsection
