@extends('admin.layouts.app')

@section('title') 
    Query 5
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection




@section('content')   

    <h2>Query 5</h2><br>
    <p>Получить список всех книг, у которых цена превышает заданное значение.</p>

    <p>This query can be executed on a standard filtering machine. <a href="{{ route('admin.books.index') }}"><b>Go to filters</b></a></p>
    <b>Tip: use price slider</b>
    
@endsection
