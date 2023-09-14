@extends('admin.layouts.app')

@section('title') 
    Query 7
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection




@section('content')   

    <h2>Query 7</h2>
    <p>Получить список всех книг, выпущенных в определенный год.</p>

    <form action="{{ route('admin.query_7') }}" method="GET">
        <div class="form-group">
            <label>Release Year:</label>
            <input type="number" name="year" value="{{ session('year')??1 }}" class="form-control" style="display: inline-block; max-width:80px; margin-left:10px;">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <br>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Book</th>
                <th scope="col">Release Year</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr>
                <th scope="row"> {{ $book->id }} </th>
                <td>{{ $book->name }}</td>
                <td>{{ $book->release_year }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection
