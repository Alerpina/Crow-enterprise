<?php

namespace App\Console\Commands;

use App\Models\Generalsetting;
use App\Models\Order;
use App\Models\User;
use App\Services\Bling;
use App\Services\Bling\DTOs\ContactDTO;
use App\Services\Bling\DTOs\OrderDTO;
use App\Services\Bling\DTOs\OrderProductDTO;
use App\Services\Bling\DTOs\TransportDTO;
use App\Services\Bling\Enums\PaymentMethod;
use Illuminate\Console\Command;

class SendOrdersToBling extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bling:order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send orders to Bling!';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bling = new Bling(Generalsetting::first()->bling_access_token);
        $bar = $this->output->createProgressBar(Order::where('payment_status', 'Completed')->where('ref_code', null)->count());
        $payments = collect($bling->getPaymentMethods());

        Order::where('payment_status', 'Completed')->where('ref_code', null)->chunk(25, function ($orders) use ($payments, $bling, $bar) {
            foreach ($orders as $order) {
                $payment = $payments->where('tipoPagamento', PaymentMethod::BankSlip->value)->first();
                if ($order->method == __('Cash on Delivery')) {
                    $payment = $payments->where('tipoPagamento', PaymentMethod::Money->value)->first();
                }

                $user = User::where('email', $order->customer_email)->first();
                $contact_id = null;

                if (!$user || !$user?->ref_code) {
                    $contact_id = $bling->createContact(new ContactDTO(
                        $order->customer_name,
                        document: $order->customer_document,
                        transport: new TransportDTO(
                            intval($order->customer_address_number),
                            $order->customer_address,
                            $order->customer_complement,
                            $order->customer_city,
                            $order->customer_country,
                            $order->customer_zip,
                            $order->customer_district
                        )
                    ))['data']['id'];
                }

                if ($user && !$user->ref_code) {
                    $user->ref_code = $contact_id;
                    $user->save();
                }

                if (!$contact_id) {
                    $contact_id = $user->ref_code;
                }

                $products_in_order = new OrderProductDTO();
                foreach ($order->cart['items'] as $product) {
                    $products_in_order->insertProduct(
                        $product['item']['sku'],
                        $product['qty'],
                        $product['item']['price'],
                        $product['item']['name'],
                        $product['item']['ref_code'],
                    );
                }

                $order->ref_code = $bling->createOrder(new OrderDTO(
                    $order->id,
                    $order->created_at,
                    $order->order_number,
                    intval($contact_id),
                    $products_in_order,
                    $order->created_at,
                    $order->pay_amount,
                    $payment['id'],
                    $order->coupon_discount,
                    new TransportDTO(
                        intval($order->shipping_address_number) ?? intval($order->customer_address_number),
                        $order->shipping_address ?? $order->customer_address,
                        $order->shipping_complement ?? $order->customer_complement,
                        $order->shipping_city != "" ? $order->shipping_city : $order->customer_city,
                        $order->shipping_country ?? $order->customer_country,
                        $order->shipping_zip ?? $order->customer_zip,
                        $order->shipping_district ?? $order->customer_district,
                        $order->shipping
                    )
                ))['data']['id'];

                $order->save();

                $bar->advance();
            }
        });

        return 0;
    }
}
