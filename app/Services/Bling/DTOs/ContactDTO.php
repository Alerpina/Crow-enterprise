<?php

namespace App\Services\Bling\DTOs;

use App\Services\Bling\Enums\TypeOfContact;

class ContactDTO
{
    public function __construct(
        private string $name,
        private TypeOfContact $type = TypeOfContact::Physical,
        private ?string $document = null,
        private ?TransportDTO $transport = null
    ) {
    }

    public function toArray(): array
    {
        $data = [
            "nome" => $this->name,
            "tipo" => $this->type,
        ];

        if ($this->transport) {
            $data['endereco']['geral'] = $this->transport->toArray();
        }

        if ($this->document) {
            $data['numeroDocumento'] = $this->document;
        }

        return $data;
    }
}