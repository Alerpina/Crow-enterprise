<?php

namespace App\Services\Bling\DTOs;

class TransportDTO
{
    public function __construct(
        private int $number,
        private string $street,
        private string $complement,
        private string $city,
        private string $fu,
        private string $zip_code,
        private string $district,
        private ?string $name = null
    ) {
    }

    public function toArray()
    {
        $data = [
            'endereco' => $this->street,
            'numero' => $this->number,
            'complemento' => $this->complement,
            'municipio' => $this->city,
            'uf' => $this->fu,
            'cep' => $this->zip_code,
            'bairro' => $this->district
        ];

        if ($this->name) {
            $data['nome'] = $this->name;
        }

        return $data;
    }
}
