@extends('_layouts.master')

@section('content')

    @javascript(compact('pusherKey'))

    <div id="app">
        <crawl-results></crawl-results>
    </div>
@endsection