<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    public $authors;
    public $genres;

    public function __construct()
    {
        $this->authors = Author::all();
        $this->genres = Genre::all();
    }

    // Query 1 - Получить список всех книг определенного автора.
    public function query1(Request $request){
        $data = $request->validate([
            'author_id' => '',
        ]);

        if(!isset($data['author_id'])){
            $data['author_id'] = 1;
        }

        $author_id = $data['author_id'];
        
        // Flash the author_id variable to the session
        session()->flash('author_id', $author_id);
        
        $books = Book::whereHas('authors', function ($query) use ($author_id){
            $query->where('authors.id', $author_id);
        })->with('authors')->get();
        
        return view('admin.queries.query1', ['authors' => $this->authors,'books' => $books]);
    }


    // Query 2 - Получить список всех книг определенного жанра.
    public function query2(Request $request){
        $data = $request->validate([
            'genre_id' => '',
        ]);

        if(!isset($data['genre_id'])){
            $data['genre_id'] = 1;
        }

        $genre_id = $data['genre_id'];
        
        // Flash the genre_id variable to the session
        session()->flash('genre_id', $genre_id);
        
        $books = Book::whereHas('genre', function ($query) use ($genre_id){
            $query->where('genres.id', $genre_id);
        })->with('genre')->get();
        
        return view('admin.queries.query2', ['genres' => $this->genres,'books' => $books]);
    }

    // Query 3 - Получить список всех книг, сортированных по году выпуска в порядке убывания.
    public function query3(){
        return view('admin.queries.query3');
    }

      // Query 4 - Получить список всех авторов, у которых количество книг в издательстве превышает заданное значение.
    public function query4(Request $request){
        $data = $request->validate([
            'books_count' => '',
        ]);

        if(!isset($data['books_count'])){
            $data['books_count'] = 1;
        }

        $books_count = $data['books_count'];

        // Flash the genre_id variable to the session
        session()->flash('books_count', $books_count);
        
        $authors = Author::withCount('books')->get();
        $authors = $authors->where('books_count', '>', $books_count);
        
        return view('admin.queries.query4', ['authors' => $authors]);
    }

    // Query 5 - Получить список всех книг, у которых цена превышает заданное значение.
    public function query5(){
        return view('admin.queries.query5');
    }

    // Query 6 - Получить список всех книг, у которых осталось менее определенного количества экземпляров в наличии.
    public function query6(Request $request){
        $data = $request->validate([
            'items' => '',
        ]);

        if(!isset($data['items'])){
            $data['items'] = 1;
        }

        $items = $data['items'];

        // Flash the genre_id variable to the session
        session()->flash('items', $items);
        $books = Book::where('items_in_stock', '<', $items)->orderBy('items_in_stock', 'desc')->get();

        // dump($items);
        // dump(session('items'));
        // dd($books);

        return view('admin.queries.query6', ['books' => $books]);
    }

    // Query 7 - Получить список всех книг, выпущенных в определенный год.
    public function query7(Request $request){
        $data = $request->validate([
            'year' => '',
        ]);

        if(!isset($data['year'])){
            $data['year'] = 2020;
        }

        $year = $data['year'];
        
        // Flash the genre_id variable to the session
        session()->flash('year', $year);
        
        $books = Book::where('release_year', $year)->get();
        
        return view('admin.queries.query7', ['books' => $books]);
    }

    // Query 8 - Получить список всех жанров, у которых есть книги в издательстве.
    public function query8(){
        
        $genres = Genre::select(['name'])
                ->withExists('books')
                ->get();


        $genres = Genre::withWhereHas('books')->get();
        return view('admin.queries.query8', ['genres' => $genres]);
    }
}
