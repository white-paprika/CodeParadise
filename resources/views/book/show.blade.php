@extends('layouts.app')

@section('title') 
    {{ $book->name }}
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection




@section('content')
<div class="container">
    <h2>{{ $book->name }}</h2>
    <img src="{{ asset($book->path) }}" alt="" style="max-width: 300px;">
    <p><b>Price: </b>{{ $book->price }}</p>
    <p><b>Genre: </b>{{ $book->genre->name }}</p>
    


    
    <h3>Comments</h3>
    <form action="{{ route('comments.store', ['id' => $book->id]) }}" method="POST">
        @csrf
        <input type="number"  min="1"  max="5" name="rating">
        <input type="text" name="content">

        <button type="submit">Add comment</button>

    </form>

    @foreach ($book->comments as $comment)
        User: {{ $comment->user->id }} <br>
        Rating: {{ $comment->rating }} <br>
        Content: {{ $comment->content }} <br>
    @endforeach

    @error('rating')
       <span class="text-danger">{{ $message }}</span> <br>
    @enderror
    @error('content')
       <span class="text-danger">{{ $message }}</span> <br> 
    @enderror
</div>
@endsection
