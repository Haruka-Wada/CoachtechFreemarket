<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Stripe\Exception\SignatureVerificationException;
use Stripe\Exception\UnexpectedValueException;
use Stripe\Stripe;
use Stripe\Webhook;
use App\Models\Item;
use App\Models\Order;

class WebhookController extends Controller
{
    public function webhook()
    {
        Stripe::setApiKey(config('services.stripe.secret_key'));
        $endpoint_secret = config('services.stripe.webhook_key');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (UnexpectedValueException $e) {
            http_response_code(400);
            exit();
        } catch (SignatureVerificationException $e) {
            http_response_code(400);
            exit();
        }

        if ($event->type == 'checkout.session.completed') {
            $session = $event->data->object;
            $this->handleCheckoutSessionCompleted($session);
        }elseif($event->type == 'checkout.session.async_payment_succeeded') {
            $session = $event->data->object;
            $this->handleCheckoutSessionAsyncPaymentSucceeded($session);
        }elseif($event->type == 'checkout.session.expired') {
            $session = $event->data->object;
            $this->handleCheckoutSessionExpired($session);
        }

        http_response_code(200);
    }

    //決済時のチェックアウトセッション完了
    public function handleCheckoutSessionCompleted($session)
    {
        $item_id = $session->metadata->item_id;
        $item = Item::find($item_id);

        Order::create([
            'user_id' => $session->metadata->user_id,
            'item_id' => $session->metadata->item_id,
            'post_code' => $session->metadata->post_code,
            'address' => $session->metadata->address,
            'building' => $session->metadata->building,
            'price' => $session->amount_total,
            'payment_status' => $session->payment_status,
            'payment_method_types' => reset($session->payment_method_types)
        ]);

        $item->update([
            'is_purchased' => 1
        ]);
    }

    //コンビニ決済、銀行決済（決済完了）
    public function handleCheckoutSessionAsyncPaymentSucceeded($session) {
        if($session->payment_status === 'paid') {
            $item_id = $session->metadata->item_id;
            $order = Order::where('item_id', $item_id)
                    ->where('payment_status', 'unpaid')->first();

            $order->update([
                'payment_status' => $session->payment_status
            ]);
        }
    }

    //セッションの有効期限切れ
    public function handleCheckoutSessionExpired($session) {
        $item_id = $session->metadata->item_id;
        $order = Order::where('item_id', $item_id)
                ->where('payment_status', 'unpaid')->first();

        $order->update([
            'payment_status' => $session->status
        ]);

        $order->item->update([
            'is_purchased' => 0
        ]);
    }
}
