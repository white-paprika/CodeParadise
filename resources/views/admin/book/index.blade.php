@extends('admin.layouts.app')

@section('title') 
    Books
@endsection

@section('styles')
    {{-- pricerange --}}
    <link rel="stylesheet" href={{ asset('css/pricerange.css') }}>
@endsection

@section('scripts')
    {{-- jQuery --}}
    <script src={{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js') }}></script>
    {{-- pricerange --}}
    <script src={{ asset('js/pricerange.js') }}></script>
    {{-- ajax for live filtering --}}
    <script src={{ asset('js/admin/books_search_ajax.js') }}></script>
@endsection




@section('content')   

    <h2>Books</h2>


    @include('includes.sidebarInclude')

    <br>
    <a href="{{ route('admin.books.create') }}" class="btn btn-primary">Add new book</a><br><br>

    <div class="content-table"> {{-- for ajax render --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Path</th>
                    <th scope="col">Items in stock</th>
                    <th scope="col">Release year</th>
                    <th scope="col">Translator</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Interact</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr>
                    <th scope="row"> {{$book->id}} </th>
                    <td>{{$book->name}}</td>
                    <td>{{$book->description}}</td>
                    <td>{{$book->price}}</td>
                    <td>{{$book->path}}</td>
                    <td>{{$book->items_in_stock}}</td>
                    <td>{{$book->release_year}}</td>
                    <td>{{$book->translator}}</td>
                    <td>{{$book->genre->name}}</td>
            
                    <td>
                        <a href="{{ route('admin.books.edit', ['book'=>$book]) }}">Edit</a>
                        <form action="{{ route('admin.books.destroy', ['book'=>$book]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
