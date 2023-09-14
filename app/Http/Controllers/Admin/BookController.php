<?php

namespace App\Http\Controllers\Admin;

use App\DTO\Book\StoreDTO;
use App\DTO\Book\UpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreRequest;
use App\Http\Requests\Book\UpdateRequest;
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
            return view('admin.ajax.books_render', [
                'books' => $books,
            ])->render();
        };

        return view('admin.book.index', ['books' => $books, 'genres' => $genres]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all(); // for multiselect
        $genres = Genre::all(); // for select
        return view('admin.book.create', ['genres' => $genres, 'authors' => $authors]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, BookService $bookService)
    {
        /**
         * Store a book using a service which takes an instance of StoreBookDTO class. (Which takes array of values returned by validaing against StoreRequest) 
         */
        $bookService->storeBook(StoreDTO::fromRequest($request));  
        return redirect()->route('admin.books.create')->withMessage('Book added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $authors = Author::all(); // for multiselect
        $genres = Genre::all(); // for select
        return view('admin.book.edit', ['book' => $book, 'genres' => $genres, 'authors' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Book $book, BookService $bookService)
    {
        $bookService->updateBook(UpdateDTO::fromRequest($request), $book);
        return redirect()->route('admin.books.index')->withMessage('Book updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->back();
    }

}
