@extends('layouts.main')

@section('MainContent')
@include('includes.BookBut')
<div class="w3l-homeblock2 py-5">
    <div class="container pt-md-4 pb-md-5">
         @foreach ($books as $book) 
        <h3 class="category-title mb-3">{{ $book->name }}</h3>
        @endforeach 
        <div class="row">
            @foreach ($books as $book)
            <div class="col-lg-5 col-md-7 item">
                    <div class="card-body blog-details">
                        <a href="{{URL('/book/'.$book->id)}}" class="blog-desc">{{ $book->title }}</a>
                        <p>{{ $book->description }}</p>
                        <div class="author align-items-center mt-4 mb-2">
                            <img src="assets/images/about1.jpg" alt="" class="img-fluid rounded-circle" />
                            <ul class="blog-meta">
                                <li>
                                    <span>Author:</span>
                                    <span>{{ $book->name }}</span>
                                </li>
                                <li class="meta-item blog-lesson">
                                    <span><span class="fa fa-clock-o"></span> Publish Year:</span>
                                        <span> {{ $book->published_year }}</span>.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <ul class="site-pagination text-center mt-md-5 mt-4">
            <li><span aria-current="page" class="page-numbers current">{{ $books->links() }}</span></li>
        </ul>
    </div>
</div>
@stop








