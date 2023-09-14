<?php

namespace App\Http\Controllers;

use App\Exceptions\BusinessException;
use App\Models\Book;
use App\Services\CartService;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * Success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout(CartService $cartService)
    {
        
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $user = auth()->user();
        $cart = $cartService::getCart($user->id);

        // Check if items exist in the cart
        if(!$cart->cartItems){
            throw new BusinessException("You have no items in cart. Pick some book! :]");
        }

        $payedItems = [];

        foreach ($cart->cartItems as $cartItem) {
            $name = $cartItem->book->name;
            $price = $cartItem->book->price;
            $unit_amount = intval($price) . '00';

            $quantity = $cartItem->quantity;
            
            // Check if goods are avaliable.
            if($quantity > $cartItem->book->items_in_stock){
                throw new BusinessException("You picked too many books. We don't have this many in stock. Try to pick less :]");
            }

            $payedItems[] = [
                'price_data' => [

                    'product_data' => [
                        'name' => $name,
                    ],

                    'currency' => 'rub',
                    'unit_amount' => $unit_amount,
                ],

                'quantity' => $quantity,
            ];
        }

        $checkoutSession = \Stripe\Checkout\Session::create([
            'line_items'             => $payedItems,
            'mode'                   => 'payment',
            'allow_promotion_codes'  => true,
            'metadata'               => [
                'user_id' => $user->id,
            ],
            'customer_email' => $user->email,
            'success_url' => route('stripe_success'),
            'cancel_url' => route('stripe_cancel'),

        ]);

        return redirect()->away($checkoutSession->url);
    }

    public function success(CartService $cartService)
    {
        $cartService->checkout();
        return "Thanks for order. You have just complited your payment.";
    }

    public function cancel()
    {
        return "The payment has been canceled.";
    }
}
