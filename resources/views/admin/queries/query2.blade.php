@extends('admin.layouts.app')

@section('title') 
    Query 2
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection




@section('content')   

    <h2>Query 2</h2>
    <p>Получить список всех книг определенного жанра.</p>

    <form action="{{ route('admin.query_2') }}" method="GET">
        <div class="form-group">
            <label>Genres:</label>
            <select class="form-control chosen-select" name="genre_id" id="" autocomplete="off">
              @foreach ($genres as $genre)
                  <option value="{{ $genre->id }}" {{ ($genre->id == session('genre_id')?"selected":"") }}>{{ $genre->name }}</option>
              @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <br>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Book</th>
                <th scope="col">Genre</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr>
                <th scope="row"> {{ $book->id }} </th>
                <td>{{ $book->name }}</td>
                <td>{{ $book->genre->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection
