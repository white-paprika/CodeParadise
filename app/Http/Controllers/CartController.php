<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\AddToCartRequest;
use App\Models\Book;
use App\Services\CartService;

class CartController extends Controller
{

    public function index(CartService $cartService){
        $user = auth()->user();
        $cart = $cartService->getCart($user->id)->load('cartItems.book');
        $total = $cartService->getTotal($cart);
        return view('cart', ['cart' => $cart, 'total' => $total]);
    }

    public function addToCart(int $id, CartService $cart){   
        Book::findOrFail($id);
        $cart->addToCart($id);
        return redirect()->route('books.index');
    }

    public function updateItemQuantity(AddToCartRequest $request, CartService $cartService, int $id){
        $request->validated();
        $cartService->updateItemQuantity($id, $request->quantity);        
    }

    public function removeItem(CartService $cartService, int $id){
        $cartService->removeItem($id);
    }
}
