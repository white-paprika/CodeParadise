@extends('admin.layouts.app')

@section('title') 
    Sales
@endsection

@section('styles')
    {{-- pricerange --}}
    {{-- <link rel="stylesheet" href={{ asset('css/pricerange.css') }}> --}}
@endsection

@section('scripts')
    {{-- jQuery --}}
    {{-- <script src={{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js') }}></script> --}}
    {{-- pricerange --}}
    {{-- <script src={{ asset('js/pricerange.js') }}></script> --}}
    {{-- ajax for live filtering --}}
    {{-- <script src={{ asset('js/books_search_ajax.js') }}></script> --}}
@endsection




@section('content')   

    <h2>Sales</h2>

    <div class="content-table"> {{-- for ajax render --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Book</th>
                <th scope="col">Price</th>
                <th scope="col">DateTime</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
            <tr>
                <th scope="row"> {{$sale->id}} </th>
                <td>{{$sale->user->name}}</td>
                <td>{{$sale->book->name}}</td>
                <td>{{$sale->price}}</td>
                <td>{{$sale->created_at}}</td>
        
                {{-- <td>
                    <a href="{{ route('books.show', ['book'=>$book]) }}">Show</a>
                    <a href="{{ route('add_to_cart', ['id'=>$book->id]) }}">Add to cart</a>
                </td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
</div>
@endsection
