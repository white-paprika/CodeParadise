@extends('layouts.app')

@section('title') 
    New book
@endsection

@section('styles')
    {{-- datepicker --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
@endsection

@section('scripts')
    {{-- jQuery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    {{-- datepicker --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <script>
        $("#datepicker").datepicker( {
            format: " yyyy", // Notice the Extra space at the beginning
            viewMode: "years", 
            minViewMode: "years"
        });
    </script>
@endsection




@section('content')
<div class="container">
    
    <h1>Create tour</h1>
    {{session('message')}}

    <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
        @csrf
        {{-- Name --}}
        <div class="form-group">
            <label>Name:</label>
            <input 
                name="name" 
                value="{{ old('name') }}"
                type="text" 
                class="form-control" 
            >
        </div>

        {{-- Description --}}
        <div class="form-group">
            <label>Description:</label>
            <textarea 
                name="description" 
                cols="30" 
                rows="10"
                class="form-control" 
            >{{ old('description') }}</textarea>
        </div>

        {{-- Genre --}}
        <div class="form-group">
        <label>Genre:</label>
            
            <select 
                name="genre_id" 
                class="form-control" 
            >
              @foreach ($genres as $genre)
                  <option value="{{ $genre->id }}" {{ ($genre->id == old('genre_id')?"selected":"") }}>{{ $genre->name }}</option>
              @endforeach
            </select>
        </div>

        {{-- Authors --}}
        <div class="form-group">
            <label>Authors:</label>
            <select multiple class="form-control chosen-select" name="authors[]" id="">
              @foreach ($authors as $author)
                  <option value="{{ $author->id }}" {{ in_array($author->id, old('authors', []))?"selected":"" }}>{{ $author->name }}</option>
              @endforeach
            </select>
        </div>

        {{-- Price --}}
        <div class="form-group">
            <label>Price:</label>
            <input 
                name="price"
                value="{{ old('price') }}"
                type="number" 
            >
        </div>

        {{-- Quantity --}}
        <div class="form-group">
            <label>Items in stock:</label>
            <input 
                name="items_in_stock"
                value="{{ old('items_in_stock') }}"
                type="number" 
            >
        </div>

        {{-- Release year --}}
        <div class="form-group">
            <label>Release year:</label>
            <input 
                name="release_year"
                value="{{ old('release_year') }}"
                type="text" 
                id="datepicker"  
            >
        </div>

        {{-- Translator --}}
        <div class="form-group">
            <label>Translator:</label>
            <input 
                name="translator"
                value="{{ old('translator') }}"
                class="form-control" 
                type="text" 
            >
        </div>

        {{-- File --}}
        <div class="form-group">
            <label>File:</label>
            <input 
                name="file"
                type="file" 
            >
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    @error('name')
       <span class="text-danger">{{ $message }}</span> <br>
    @enderror
    @error('description')
       <span class="text-danger">{{ $message }}</span> <br> 
    @enderror
    @error('genre_id')
       <span class="text-danger">{{ $message }}</span> <br> 
    @enderror
    @error('authors')
       <span class="text-danger">{{ $message }}</span> <br> 
    @enderror
    @error('price')
       <span class="text-danger">{{ $message }}</span> <br> 
    @enderror
    @error('quantity')
       <span class="text-danger">{{ $message }}</span> <br> 
    @enderror
    @error('release_year')
       <span class="text-danger">{{ $message }}</span> <br> 
    @enderror
    @error('translator')
       <span class="text-danger">{{ $message }}</span> <br> 
    @enderror
    @error('file')
       <span class="text-danger">{{ $message }}</span> <br> 
    @enderror
    


</div>
@endsection
