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
    ) {
    }

    public function toArray()
    {
        return [
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
    }
}
