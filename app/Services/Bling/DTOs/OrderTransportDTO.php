<?php

namespace App\Services\Bling\DTOs;

class OrderTransportDTO
{
    public function __construct(
        private int $number,
        private string $street,
        private string $complement,
        private string $city,
        private string $fu,
        private string $zip_code,
        private string $district
    ) {
    }

    public function toArray()
    {
        return [
            'endereco' => $this->street,
            'numero' => $this->number,
            'complemento' => $this->complement,
            'municipio' => $this->city,
            'uf' => $this->fu,
            'cep' => $this->zip_code,
            'bairro' => $this->district
        ];
    }
}
