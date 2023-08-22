<?php

namespace App\Console\Commands;

use App\Models\Generalsetting;
use App\Models\Order;
use App\Models\User;
use App\Services\Bling;
use App\Services\Bling\DTOs\ContactDTO;
use App\Services\Bling\DTOs\OrderDTO;
use App\Services\Bling\DTOs\OrderProductDTO;
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
    
                if (!$user || !$user?->ref_code) {
                    $contact_id = $bling->createContact(new ContactDTO(
                        $order->customer_name
                    ))['data']['id'];
                }
    
                if ($user && !$user->ref_code) {
                    $user->ref_code = $contact_id;
                    $user->save();
                }

                $contact_id = $user->ref_code;
    
                $products_in_order = new OrderProductDTO();
                foreach ($order->cart['items'] as $product) {
                    $products_in_order->insertProduct(
                        $product['item']['id'],
                        $product['qty'],
                        $product['item']['price'],
                        $product['item']['name']
                    );
                }
    
                $order->ref_code = $bling->createOrder(new OrderDTO(
                    $order->id,
                    $order->created_at,
                    $order->order_number,
                    intval($contact_id),
                    $products_in_order,
                    $order->created_at,
                    $order->cart['totalPrice'],
                    $payment['id']
                ))['data']['id'];

                $order->save();

                $bar->advance();
            }
        });

        return 0;
    }
}
