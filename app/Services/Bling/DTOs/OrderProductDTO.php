<?php

namespace App\Services\Bling\DTOs;

use DateTimeInterface;

class OrderProductDTO
{
    private array $products;

    public function insertProduct(string $code, int $quantity, float $value, string $description, ?string $ref_code = null)
    {
        $data = [
            'codigo' => $code,
            'unidade' => 'UN',
            'quantidade' => $quantity,
            'valor' => $value,
            'descricao' => $description,
        ];

        if ($ref_code) {
            $data['produto']['id'] = $ref_code;
        }

        $this->products[] = $data;
    }

    public function toArray(): array
    {
        return $this->products;
    }
}