@extends('_layouts.master')

@section('content')

    @javascript(compact('pusherKey'))

    <div id="app">
        <dashboard></dashboard>
    </div>
@endsection