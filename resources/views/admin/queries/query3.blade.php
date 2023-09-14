@extends('admin.layouts.app')

@section('title') 
    Query 3
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection




@section('content')   

    <h2>Query 3</h2><br>
    <p>Получить список всех книг, сортированных по году выпуска в порядке убывания.</p>

    <p>This query can be executed on a standard filtering machine. <a href="{{ route('admin.books.index') }}"><b>Go to filters</b></a></p>
    <b>Tip: sort by "Release year: new first"</b>
    
@endsection
