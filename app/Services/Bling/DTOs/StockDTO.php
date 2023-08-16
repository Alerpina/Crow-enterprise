<?php

namespace App\Services\Bling\DTOs;

use App\Services\Bling\Enums\Operation;

class StockDTO
{
    public function __construct(
        public int $product_id,
        public int $warehouse_id,
        public float $quantity,
        public Operation $operation = Operation::Balance,
    ) {
    }

    public function toArray(): array
    {
        return [
            'produto' => [
                'id' => $this->product_id
            ],
            'deposito' => [
                'id' => $this->warehouse_id
            ],
            "operacao" => $this->operation->value,
            "quantidade" => $this->quantity,
        ];
    }
}
