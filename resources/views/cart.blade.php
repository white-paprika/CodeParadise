@extends('layouts.app')

@section('title') 
    Home
@endsection

@section('styles')
    
@endsection

@section('scripts')
    {{-- jQuery --}}
    <script src={{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js') }}></script>
    {{-- Updating cart item quantity --}}
    <script type="text/javascript">
        $(".quantityInput").change(function (e) {
            e.preventDefault();
            var elem = $(this);
            var newQuantity = elem.val();
            var cartItemId = elem.parents('tr').attr('item-id');            

            $.ajax({
                url:"/update-cart-item-quantity/" + cartItemId, 
                type:"PATCH",        
                data: {
                    "_token": "{{ csrf_token() }}",
                    "quantity": newQuantity,
                },              
                success: function(response) {
                    window.location.reload();
                    // console.log(response);
                },
                error: function(xhr, status, error) {
                console.log('AJAX CUSTOM ERROR RESPONSE')
                console.log(xhr.responseText);
                console.log(status);
                console.log(error);
                }
                
            })

        })
    </script>
    {{-- Removing item from cart --}}
    <script type="text/javascript">
        
        $('.remove-from-cart-btn').click(function (e) {
            e.preventDefault();

            if(confirm('Remove this item from cart?')){
    
                var elem = $(this);
                var cartItemId = elem.parents('tr').attr('item-id');   
    
                $.ajax({
                    url:"/remove-from-cart/" + cartItemId, 
                    type:"DELETE",        
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },              
                    success: function(response) {
                        // console.log(response);
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                    console.log('AJAX CUSTOM ERROR RESPONSE')
                    console.log(xhr.responseText);
                    console.log(status);
                    console.log(error);
                    }
                    
                })
            }
        });
    </script>
@endsection




@section('content')
<div class="container">
    <h2>My Cart</h2>
    
    <table class="table">
        <tbody>
            @foreach ($cart->cartItems as $item)
            <tr item-id="{{$item->id}}">
                <td>
                    <a href="{{ route('books.show', ['book'=>$item->book]) }}">
                        <img src="{{ asset($item->book->path)}}" class="img-fluid" alt="...">
                    </a>
                </td>
                <td>
                    <a href="{{ route('books.show', ['book'=>$item->book]) }}">
                        {{ $item->book->name }}
                    </a>
                </td>
                <td>{{ $item->book->price }}руб.</td>
                <td>
                    <input type="number"
                            name="quantity" 
                            class="quantityInput form-control" 
                            min="1" 
                            max="{{ $item->book->items_in_stock }}" 
                            value="{{ $item->quantity }}" 
                            autocomplete="off"
                            style="min-width:68px;"
                    >
                </td>
                <td>
                    <button class="btn btn-danger remove-from-cart-btn">Delete</button>
                </td>
            </tr>
            @endforeach    
        </tbody>
    </table>
    Total: {{$total}}
             
    <a class="btn btn-danger" href="{{ route('books.index') }}">Continue shopping</a>
    <a class="btn btn-success" href="{{ route('stripe_checkout') }}">Checkout</a>

</div>
@endsection
