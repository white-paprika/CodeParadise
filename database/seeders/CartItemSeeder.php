<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cart = new Cart;
        $cart->id = 2;
        $cart->user_id = 2;
        $cart->save();

        $cartItem = new CartItem;
        $cartItem->cart_id = 2;
        $cartItem->book_id = 16;
        $cartItem->quantity = 6;
        $cartItem->save();

        $cartItem = new CartItem;
        $cartItem->cart_id = 2;
        $cartItem->book_id = 12;
        $cartItem->quantity = 3;
        $cartItem->save();

    }
}
