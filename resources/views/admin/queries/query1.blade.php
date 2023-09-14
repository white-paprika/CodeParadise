@extends('admin.layouts.app')

@section('title') 
    Query 1
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection




@section('content')   

    <h2>Query 1</h2>
    <p>Получить список всех книг определенного автора.</p>

    <form action="{{ route('admin.query_1') }}" method="GET">
        <div class="form-group">
            <label>Authors:</label>
            <select class="form-control chosen-select" name="author_id" id="" autocomplete="off">
              @foreach ($authors as $author)
                  <option value="{{ $author->id }}" {{ ($author->id == session('author_id')?"selected":"") }}>{{ $author->name }}</option>
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
                <th scope="col">Authors</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr>
                <th scope="row"> {{ $book->id }} </th>
                <td>{{ $book->name }}</td>
                <td>
                    @foreach ($book->authors as $author)
                        <p>{{ $author->name }}</p>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection
