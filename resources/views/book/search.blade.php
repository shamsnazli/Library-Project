@extends('layouts.main')

@section('MainContent')
@include('includes.BookBut')
<div class=" py-5">
    <div class="container pt-md-4 pb-md-5">
        @foreach ($books as $book) 
        <h3 class="category-title mb-3">{{ $book->category }}</h3>
        @endforeach
        <div class="row">
            @foreach ($books as $book)
            <div class="col-lg-4 col-md-6 item">
                <div class="card">
                    <div class="card-header p-0 position-relative">
                        <a href="#blog-single.html">
                            <img class="card-img-bottom d-block radius-image-full" src="{{ asset($book->image) }}"
                                alt="Card image cap">
                        </a>
                    </div>
                    <div class="card-body blog-details">
                        <a href="{{ URL('/book/'. $book->id) }}" class="blog-desc">{{ $book->book_title }}</a>
                        <p>{{ $book->description }}</p>
                        <div class="author align-items-center mt-3 mb-1">
                            <img src="assets/images/banner3.jpg" class="img-fluid" >
                            <ul class="blog-meta">
                                <li>
                                    <span>Author: {{ $book->name }}</span>
                                </li>
                                <li class="meta-item blog-lesson">
                                    <span><span class="fa fa-clock-o">
                                        <span>Published Year: {{ $book->published_year }} </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
    </div>
</div>
@stop
