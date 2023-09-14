<?php

namespace App\Http\Controllers;

use App\Cart\Cart;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, BookService $bookService)
    {
        $genres = Genre::all(); // for checkboxes
        $books = $bookService->filterBooks();

        // if request is sent with ajax, return booksRender subview with $books 
        // NOTE: ajax recieves this return as a response in success of ajax function (check public\js\books_search_ajax.js)
        if ($request->ajax()){ 
            return view('ajax.books_render', [
                'books' => $books,
            ])->render();
        };

        return view('book.index', ['books' => $books, 'genres' => $genres]);
    }
  
    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {   
        return view('book.show', ['book' => $book->load('comments.user')]);
    }

}
