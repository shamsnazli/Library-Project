@extends('layouts.main')

@section('MainContent')
@include('includes.BookBut')
<div class="w3l-homeblock2 py-5">
    <div class="container pt-md-4 pb-md-5">
        @foreach ($publishers as $publisher)
        <div class="align-items-center my-3">
            <a href="{{URL('/book/author/'.$publisher->id)}}">
                <p class="category-title mb-3">Publishers: {{ $publisher->name }}</p>
            </a>
        </div>
        @endforeach
    </div>
</div>
@stop
