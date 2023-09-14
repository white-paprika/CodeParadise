@extends('admin.layouts.app')

@section('title') 
    Query 6
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection




@section('content')   

    <h2>Query 6</h2>
    <p>Получить список всех книг, у которых осталось менее определенного количества экземпляров в наличии.</p>

    <form action="{{ route('admin.query_6') }}" method="GET">
        <div class="form-group">
            <label>Items in stock less than:</label>
            <input type="number" name="items" value="{{ session('items')??1 }}" class="form-control" style="display: inline-block; max-width:80px; margin-left:10px;">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <br>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Book</th>
                <th scope="col">Items in stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr>
                <th scope="row"> {{ $book->id }} </th>
                <td>{{ $book->name }}</td>
                <td>{{ $book->items_in_stock }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
@endsection
