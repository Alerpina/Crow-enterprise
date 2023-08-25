<?php

namespace App\Services\Bling\DTOs;

use DateTimeInterface;

class OrderDTO
{
    public function __construct(
        private int $id,
        private DateTimeInterface $date,
        private string $orderNumber,
        private int $contactId,
        private OrderProductDTO $products,
        private DateTimeInterface $payment_date,
        private float $payment_value,
        private int $payment_id,
        private ?float $discount = null,
        private ?TransportDTO $transport = null,
    ) {
    }

    public function toArray()
    {
        $data = [
            'numero' => $this->id,
            'data' => $this->date,
            'numeroPedidoCompra' => $this->orderNumber,
            'contato' => [
                'id' => $this->contactId
            ],
            'itens' => $this->products->toArray(),
            'parcelas' => [
                0 => [
                    'dataVencimento' => $this->payment_date,
                    'valor' => $this->payment_value,
                    'formaPagamento' => [
                        'id' => $this->payment_id
                    ]
                ]
            ]
        ];

        if ($this->discount) {
            $data['desconto']['valor'] = $this->discount;
        }

        if ($this->transport) {
            $data['transporte']['etiqueta'] = $this->transport->toArray();
        }

        return $data;
    }
}
