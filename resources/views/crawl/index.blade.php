@extends('_layouts.master')

@section('content')

    @javascript(compact('pusherKey'))

    <div id="app">
        <app-header></app-header>
        <div class="container">
          <router-view></router-view>
        </div>
    </div>
@endsection
