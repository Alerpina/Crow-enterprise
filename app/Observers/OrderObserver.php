<?php

namespace App\Observers;

use App\Mail\RedplayLicenseMail;
use App\Models\License;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderObserver
{

    /**
     * Handle the order "updated" event.
     *
     * @param Order $order
     * @return void
     */
    public function updated(Order $order)
    {
        if (config('features.redplay_digital_product')) {
            if ($order->payment_status === 'Completed') {
                $cart = $order->cart;
                foreach ($cart['items'] as $cartItem) {
                    $product = $cartItem['item'];
                    if ($product->licenses) {
                        $licenseToBeSentByEmail = License::where('product_id', $product->id)->where('available', true)->first();
                        if ($licenseToBeSentByEmail) {
                            Log::debug('License to be Sent: ', [$licenseToBeSentByEmail]);

                            Mail::to($order->customer_email)->queue(new RedplayLicenseMail($order, $licenseToBeSentByEmail));

                            $licenseToBeSentByEmail->available = false;
                            $licenseToBeSentByEmail->update();
                        }
                    }
                }
            }
        }
    }
}
