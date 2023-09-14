@extends('admin.layouts.app')

@section('title') 
    Query 8
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection




@section('content')   

    <h2>Query 8</h2>
    <p>Получить список всех жанров, у которых есть книги в издательстве.</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Genre</th>
                <th scope="col">Books</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($genres as $genre)
            <tr>
                <th scope="row"> {{ $genre->id }} </th>
                <td>{{ $genre->name }}</td>
                <td>
                    @foreach ($genre->books as $book)
                            <a href="{{ route('books.show', ['book'=>$book]) }}">{{ $book->name }}</a><br>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection
