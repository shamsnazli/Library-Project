<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Book;
use App\Author;
use App\Category;
use App\Publisher;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::with('publisher')->with('books_author')->with('books_author.author')->with('books_category')->with('books_category.category')->get();
        
        foreach ($books as $book) {
    		$img_link = Storage::url($book->image);
    		$book->image = $img_link;
    	}
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();
        // dd($authors);
        // dd($books);
        return view('book.index')->with('books', $books)->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }

    public function viewBooks()
    {
        $paginate = 5;
        $books = Book::with('publisher')->with('books_author')->with('books_author.author')->with('books_category')->with('books_category.category')->orderBy('id','Asc')->paginate($paginate);
        
        foreach ($books as $book) {
    		$img_link = Storage::url($book->image);
    		$book->image = $img_link;
    	}
        // for layouts/main.blade.php
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

        return view('book.view_books')->with('books', $books)->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }

    public function viewBook($id)
    {
        $book = Book::where('id', $id)->with('publisher')->with('books_author')->with('books_author.author')->with('books_category')->with('books_category.category')->first(); // Model
        
        $img_link = Storage::url($book->image);
    	$book->image = $img_link;

        // for layouts/main.blade.php
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

        return view('book.book')->with('book', $book)->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }

    public function viewPublisherBook($id)
    {
        $books = Book::where('publisher_id', $id)->with('publisher')->with('books_author')->with('books_author.author')->with('books_category')->with('books_category.category')->orderBy('id','Asc')->first(); // Model
        
        foreach ($books as $book) {
    		$img_link = Storage::url($book->image);
    		$book->image = $img_link;
    	}
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

        return view('book.publisher')->with('books', $books)->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }



    public function viewAuthorBook($id)
    {
        $books = DB::table('books')->join('publishers', 'books.publisher_id', 'publishers.id')
        ->join('books_authors', 'books.id', 'books_authors.book_id')->join('authors', 'books_authors.author_id', 'authors.id')
        ->join('books_categories', 'books.id', 'books_categories.book_id')
        ->join('categories', 'books_categories.category_id', 'categories.id')
        ->where('authors.id', $id)->first();
        
        foreach ($books as $book) {
                $img_link = Storage::url($book->image);
                $book->image = $img_link;
    	}

        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();
        // dd($books);
        return view('book.author')->with('books', $books)->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }



    public function viewCategoryBook($id)
    {
        $books = DB::table('books')->join('publishers', 'books.publisher_id', 'publishers.id')
        ->join('books_authors', 'books.id', 'books_authors.book_id')->join('authors', 'books_authors.author_id', 'authors.id')
        ->join('books_categories', 'books.id', 'books_categories.book_id')
        ->join('categories', 'books_categories.category_id', 'categories.id')
        ->where('categories.id', $id)->first();
        
        foreach ($books as $book) {
                $img_link = Storage::url($book->image);
                $book->image = $img_link;
    	}
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

        return view('book.category')->with('books', $books)
        ->with('categories', $categories)->with('publishers', $publishers)
        ->with('authors', $authors);
    }


    public function viewAuthors()
    {
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

        return view('book.view_authors')->with('publishers', $publishers)->
        with('authors', $authors)->with('categories', $categories);
    }
    public function viewCategories()
    {
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

        return view('book.view_categories')->with('categories', $categories)
        ->with('publishers', $publishers)->with('authors', $authors);
    }
    
    public function viewPublishers()
    {
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();
        return view('book.view_publishers')
        ->with('categories', $categories)->

        with('publishers', $publishers)->
        with('authors', $authors);
    }

    public function search()
    {
        $search_text = $_GET['search'];
        $books = DB::table('books')->join('publishers','books.publisher_id','publishers.id')
        ->join('books_authors', 'books.id', 'books_authors.book_id')
        ->join('authors', 'books_authors.author_id', 'authors.id')
        ->join('books_categories', 'books.id', 'books_categories.book_id')
        ->join('categories', 'books_categories.category_id', 'categories.id')
        ->where('books.book_title', 'LIKE','%'. $search_text .'%')
        ->orwhere('publishers.name', 'LIKE','%'. $search_text .'%')
        ->orwhere('authors.name', 'LIKE','%'. $search_text .'%')
        ->orwhere('categories.category', 'LIKE','%'. $search_text .'%')->get();

        foreach ($books as $book) {
            $img_link = Storage::url($book->image);
            $book->image = $img_link;
    }
    $categories = Category::select('id', 'category')->get();
    $authors = Author::select('id', 'name')->get();
    $publishers = Publisher::select('id', 'name')->get();

    return view('book.search')->with('books', $books)
    ->with('categories', $categories)
    ->with('authors', $authors)->with('publishers', $publishers);
    }
}
