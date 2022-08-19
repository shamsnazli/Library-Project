@extends('layouts.main')

@section('MainContent')
@include('includes.BookBut')


<div class="w3l-homeblock2 py-5">
    <div class="container pt-md-4 pb-md-5">

        @foreach ($categories as $category)
        <div class="align-items-center my-4">
            <a href="{{URL('/book/author/'.$category->id)}}">
                <p class="category-title mb-4">Categories: {{ $category->category }}</p>
            </a>
        </div>
        @endforeach
    </div>
</div>
@stop
