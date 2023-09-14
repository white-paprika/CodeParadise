<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bestSellers = DB::table('books')
        ->join('sales', 'books.id', '=', 'sales.book_id')
        ->select('books.*', DB::raw('COUNT(sales.id) as sales_count'))
        ->groupBy('books.id')
        ->orderBy('sales_count', 'desc')
        ->limit(6)
        ->get();

        $newBooks = DB::table('books')
        ->orderBy('created_at', 'desc')
        ->limit(6)
        ->get();

        // dump($bestSellers, $newBooks);

        return view('home', ['bestSellers' => $bestSellers, 'newBooks' => $newBooks]);
    }
}
