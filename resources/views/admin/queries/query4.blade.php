@extends('admin.layouts.app')

@section('title') 
    Query 4
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection




@section('content')   

    <h2>Query 4</h2>
    <p>Получить список всех авторов, у которых количество книг в издательстве превышает заданное значение.</p>

    <form action="{{ route('admin.query_4') }}" method="GET">
        <div class="form-group">
            <label>Authors who have books more than:</label>
            <input type="number" name="books_count" value="{{ session('books_count')??1 }}" class="form-control" style="display: inline-block; max-width:80px; margin-left:10px;">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <br>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Author</th>
                <th scope="col">Has books</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($authors as $author)
            <tr>
                <th scope="row"> {{ $author->id }} </th>
                <td>{{ $author->name }}</td>
                <td>{{ $author->books_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection
