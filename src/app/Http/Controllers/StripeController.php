<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function checkout(PurchaseRequest $request)
    {
        $user = User::find(Auth::id());
        $stripeCustomer = $user->createOrGetStripeCustomer();
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $item = Item::find($request->item_id);

        $checkout_session = $stripe->checkout->sessions->create([
            'customer' => $stripeCustomer->id,
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name ,
                    ],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'payment_method_types' => [
                    $request->payment
                ],
            'payment_method_options' => [
                'customer_balance' => [
                    'funding_type' => 'bank_transfer',
                    'bank_transfer' => [
                    'type' => 'jp_bank_transfer',
                        ],
                    ],
                ],
            'metadata' => [
                'user_id' => Auth::id(),
                'item_id' => $request->item_id,
                'post_code' => $request->post_code,
                'address' => $request->address,
                'building' => $request->building
            ],
            'success_url' => route('success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cancel')
        ]);

        return redirect($checkout_session->url);
    }

    public function success()
    {
        return view('stripe.success');
    }

    public function cancel()
    {
        return view('stripe.cancel');
    }
}
