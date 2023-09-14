@extends('layouts.app')

@section('title') 
    Home
@endsection

@section('styles')
    
@endsection

@section('scripts')

@endsection




@section('content')
<div class="container">
    <h2>Best Sellers</h2>
    @dump($bestSellers)
    <h2>New Books</h2>
    @dump($newBooks)
</div>
@endsection
