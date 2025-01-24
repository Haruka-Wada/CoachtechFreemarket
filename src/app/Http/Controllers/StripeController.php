<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use Stripe\Stripe;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function checkout(PurchaseRequest $request)
    {
        Stripe::setApiKey(config('services.stripe.secret_key'));
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $item = Item::find($request->item_id);
        $checkout_session = $stripe->checkout->sessions->create([
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
            'metadata' => [
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


    public function success(Request $request) {
        $checkoutSession = $request->user()->stripe()->checkout->sessions->retrieve($request->get('session_id'));
        $item = Item::find($checkoutSession->metadata->item_id);

        Order::create([
            'user_id' => Auth::id(),
            'item_id' => $checkoutSession->metadata->item_id,
            'post_code' => $checkoutSession->metadata->post_code,
            'address' => $checkoutSession->metadata->address,
            'building' => $checkoutSession->metadata->building,
            'price' => $checkoutSession->amount_total
        ]);

        $item->update([
            'is_purchased' => 1
        ]);

        return view('stripe.success');
    }

    public function cancel() {
        return view('stripe.cancel');
    }
}
