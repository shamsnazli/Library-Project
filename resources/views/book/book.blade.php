@extends('layouts.main')

@section('MainContent')
@include('includes.BookBut')
<div class="py-5">
    <div class="container pt-md-5 pb-md-6">
        <h2 class="category-title mb-3">{{ $book->title }}</h2>
        <div class="row">
            <div class="col-lg-4 contacts-5-grid-main section-gap mt-lg-0 mt-5">
                <img class="card-img-bottom d-flex" src="{{ asset($book->image) }}">
            </div>
            <div class="col-lg-8 item">
                <div class="about align-items-center my-3">
                    <h3>About Book:</h3>
                    <p class="message">{{ $book->description }}</p>
                </div>
                <div class="align-items-center  my-3">
                    @if (!empty($book->books_author))
                        @foreach ($book->books_author as $books_author)
                            @if (!empty($books_author->author))
                                    <a href="{{URL('/book/author/'.$books_author->author['id'])}}">
                                    <p class="meta-value message">Author: {{ $books_author->author['name'] }}
                            @endif
                        @endforeach
                    </p></a>
                    @endif
                </div>

                <div class="align-items-center category my-3">
                    @if (!empty($book->books_category))
                        @foreach ($book->books_category as $books_category)
                            @if (!empty($books_category->category))
                                <h3>Category:</h3>
                                <a href="{{URL('/book/category/'.$books_category->category['id'])}}"><p
                                 class="meta-value message">{{ $books_category->category['category'] }}
                            @endif
                        @endforeach
                    </p></a>
                    @endif
                </div>

                <div class="align-items-center  my-3 publisher ">
                    @if (!empty($book->publisher_id))
                        <h3>Publisher:</h3>
                        <a href="{{URL('/book/publisher/'.$book->publisher['id'])}}"><p class="meta-value message">{{ $book->publisher['name'] }}</p></a>
                    @endif
                </div>

              


                <div class="about align-items-center  my-3">
                    <p class="meta-value message">Published Year: {{ $book->published_year }}</p>
                </div>


                <div class="about align-items-center  my-3">
                    <p class="meta-value message">Published Number: {{ $book->published_number }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
















