<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthorRequest;
use App\Http\Requests\BookRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\PublisherRequest;
use Illuminate\Support\Facades\Storage;
use App\Book;
use App\Author;
use App\Category;
use App\BooksAuthor;
use App\BooksCategory;
use App\Publisher;

class AdminController extends Controller
{
    public function index(){
        $paginate = 4;
        $books = Book::with('publisher')->with('books_author')->with('books_author.author')->with('books_category')->with('books_category.category')->paginate($paginate);
        
        foreach ($books as $book) {
    		$img_link = Storage::url($book->image);
    		$book->image = $img_link;
    	}
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

        return view('admin.index')->with('books', $books)->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }

    public function createBook(){
        $categories = Category::select('id', 'category')->get();
        $publishers = Publisher::select('id', 'name')->get();
        $authors = Author::select('id', 'name')->get();

    	return view('admin.create_book')->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }

    public function storeBook(BookRequest $request) {
        $image = $request->file('image');
		$path = 'images/uploads/';
		$name = time()+rand(1, 10000000000) . '.' . $image->getClientOriginalExtension();
		Storage::disk('local')->put($path.$name , file_get_contents($image));
		Storage::disk('local')->exists($path.$name);
		// store in DB
        $title = $request['title'];
        $description = $request['description'];
		$published_year = $request['published_year'];
		$published_number = $request['published_number'];
		$publisher_id = $request['publisher_id'];
		$author_id = $request['author_id'];
		$category_id = $request['category_id'];

		$book = new Book();
		$book->title = $title;
        $book->image = $path.$name;
		$book->description = $description;
		$book->published_year = $published_year;
		$book->published_number = $published_number;
		$book->publisher_id = $publisher_id;
        $book_result = $book->save();

        $author = new BooksAuthor();
        $author->book_id =$book->id;
        $author->author_id = $author_id;
        $author_result = $author->save();

        $category = new BooksCategory();
        $category->book_id =$book->id;
        $category->category_id =$category_id;
        $category_result = $category->save();
		
		return view('admin.create_book')
        ->with('add_status', [$book_result, $author_result, $category_result]);
    }

    public function createAuthor(){
        $categories = Category::select('id', 'category')->get();
        $authors = Author::select('id', 'name')->get();
        $publishers = Publisher::select('id', 'name')->get();

    	return view('admin.create_author')
        ->with('categories', $categories)->with('publishers', $publishers)
        ->with('authors', $authors);
    }

    public function storeAuthor(AuthorRequest $request) {
        $name = $request['name'];
		$author = new Author();
        $author->name = $name;
        $result = $author->save();
		return redirect()->back()->with('add_status', $result);
    }
    public function createPublisher(){
        $categories = Category::select('id', 'category')->get();;
        $authors = Author::select('id', 'name')->get();
        $publishers = Publisher::select('id', 'name')->get();
    	return view('admin.create_publisher')->with('categories', $categories)
        ->with('authors', $authors)->with('publishers', $publishers);
    }

    public function storePublisher(PublisherRequest $request) {
        $name = $request['name'];
		$publisher = new Publisher();
        $publisher->name = $name;
        $result = $publisher->save();
		return redirect()->back()->with('add_status', $result);


    }


    public function createCategory(){
        $categories = Category::select('id', 'category')->get();
        $authors = Author::select('id', 'name')->get();
        $publishers = Publisher::select('id', 'name')->get();

        
    	return view('admin.create_category')->with('categories', $categories)
        ->with('authors', $authors)->with('publishers', $publishers);
    }

    public function storeCategory(CategoryRequest $request) {
        $name = $request['name'];
		$category = new Category();
        $category->category = $name;
        $result = $category->save();
		return redirect()->back()->with('add_status', $result);

    }

    public function edit($id){
        $book = Book::where('id', $id)->with('publisher')->with('books_author')->with('books_author.author')
        ->with('books_category')->with('books_category.category')->first(); // Model
        
        $img_link = Storage::url($book->image);
    	$book->image = $img_link;

        $books_categories = BooksCategory::select('id', 'book_id', 'category_id')->get();
        $books_publishers = Publisher::select('id', 'name')->get();
        $books_authors = BooksAuthor::select('id','book_id', 'author_id')->get();


        $categories = Category::select('id', 'category')->get();
        $authors = Author::select('id', 'name')->get();
        $publishers = Publisher::select('id', 'name')->get();


        return view('admin.edit')->with('book', $book)->with('books_categories', $books_categories)->with('books_publishers', $books_publishers)->with('books_authors', $books_authors)->with('categories', $categories)->with('publishers', $publishers)->with('authors', $authors);
    }

    public function update(BookRequest $request, $id){
        if (!empty($request['image'])){
            $image = $request->file('image');
            $path = 'uploads/images/';
            $name = time()+rand(1, 10000000000000000000) . '.' . $image->getClientOriginalExtension();
            Storage::disk('local')->put($path.$name , file_get_contents($image));
            Storage::disk('local')->exists($path.$name);
        }

        $title = $request['title'];
        $image = $request['image'];
        $description = $request['description'];
		$published_year = $request['published_year'];
		$published_number = $request['published_number'];
		$publisher_id = $request['publisher_id'];
		$author_id = $request['author_id'];
        $category_id = $request['category_id'];
        
        $book = Book::where('id',$id)->first();
        $book->title = $title;
        if (!empty($image)){
            $book->image = $path.$name;
        }
		$book->description = $description;
		$book->published_year = $published_year;
		$book->published_number = $published_number;
		$book->publisher_id = $publisher_id;
		$book_result = $book->save();

        $author = BooksAuthor::where('book_id', $book->id)->first();
        if ($request['author_id'] != $author->author_id){
            $author->author_id = $author_id;
        
         }
        
         $author_result = $author->save();

        $category = BooksCategory::where('book_id', $book->id)->first();
        if ($request['category_id'] != $category->category_id){
            $category->category_id =$category_id;
        }
        $category_result = $category->save();
		
		return redirect()->back()->with('edit_status', [$book_result, $author_result, $category_result]);
    }

    public function destroy($id){
        Book::where('id',$id)->delete();
        return redirect()->back();
    }


}
