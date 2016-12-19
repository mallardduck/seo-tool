@extends('_layouts.master')

@section('content')

    @javascript(compact('pusherKey'))

    <div id="app">
        <crawl></crawl>
    </div>
@endsection