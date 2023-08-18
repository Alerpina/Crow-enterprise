<?php

namespace App\Services\Bling\DTOs;

use DateTimeInterface;

class OrderProductDTO
{
    private array $products;

    public function insertProduct(int $id, int $quantity, float $value, string $description)
    {
        $this->products[] = [
            'id' => $id,
            'quantidade' => $quantity,
            'valor' => $value,
            'descricao' => $description,
        ];
    }

    public function toArray(): array
    {
        return $this->products;
    }
}