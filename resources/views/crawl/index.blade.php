@extends('_layouts.master')

@section('content')

    @javascript(compact('pusherKey'))

    <div id="app">
        <my-header></my-header>
        <router-view></router-view>
    </div>
@endsection