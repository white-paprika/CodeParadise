<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class CartService
{
    public static function getCart(int $id): Cart
    {
        // Ищет корзину переданного юзера
        $cart = Cart::where('user_id', $id)->with('cartItems.book')->first();
        
        // Если не находит, создает новую
        if(!$cart){
            $cart = new Cart;
            $cart->id = $id;
            $cart->user_id = $id;
            $cart->save();
        }

        return $cart;
    }

    public function addToCart(int $id): void
    {
        // Корзина авторизованного юзера (либо существующая, либо новая)
        $cart = $this->getCart(auth()->user()->id);
        // Ищет книгу, которую пользователь хочет добавить
        $book = Book::find($id);
        // Если находит 
        if ($book) {
            // Ищет в корзине текущего юзера запись, сопряженную с книгой 
            $cartItem = $cart->cartItems()->where('book_id', $book->id)->first();
            // Если не находит, создает новую, подставляя данные о корзине и книге
            // Если находит, инкрементирует поле quantity. 
            if(!$cartItem){
                $cartItem = new CartItem;
                $cartItem->cart_id = $cart->id;
                $cartItem->book_id = $book->id;
                $cartItem->quantity = 1;
            }else{
                $quantity = $cartItem->quantity;
                $quantity++;
                $cartItem->quantity = $quantity;
            }
            // Сохраняет запись, обновляет модель
            $cartItem->save();
            $cart->refresh();
            // dd($cart);
        }
    }
    
    public function updateItemQuantity(int $id, int $quantity): void
    {
        $cartItem = CartItem::find($id);
        $cartItem->quantity = $quantity;
        $cartItem->save();
        $cartItem->refresh();
    }
    
    public function removeItem(int $id): void
    {
        $cartItem = CartItem::find($id);
        $cartItem->delete();
    }

    public function getTotal(Cart $cart): float
    {
        // Корзина авторизованного юзера (либо существующая, либо новая)
        $total = 0;
        foreach ($cart->cartItems as $item){
            $total += $item->quantity * $item->book->price;
        }
        return $total;
    }

    public function checkout(){
        $user_id = auth()->user()->id;

        $cart = $this->getCart($user_id);

        $books_id = $cart->cartItems()->pluck('book_id')->toArray();
        
        try{
            DB::beginTransaction();

            // making sales
            foreach ($books_id as $book_id){
                // get quantity of each cart item
                $quantity = CartItem::where('book_id', $book_id)
                            ->where('cart_id', $cart->id)
                            ->first()
                            ->quantity;
                // create new sales (x $quantity records for each cart item)
                for ($i = 0; $i < $quantity; $i++){
                    $sale = new Sale;
                    $sale->user_id = $user_id;
                    $sale->book_id = $book_id;
                    $sale->price = Book::find($book_id)->price;
                    $sale->save();
                };

                // Reduce in_stock
                $book = Book::find($book_id);
                $book->reduceItemsInStock($quantity);
                $book->save();

            }

            // Clear cart
            $cart->cartItems()->delete();

            DB::commit();

        } catch(\Exception $e) {
            DB::rollBack();
            throw $e;
        }

    }

    // public function 
}