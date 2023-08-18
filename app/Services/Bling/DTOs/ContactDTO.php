<?php

namespace App\Services\Bling\DTOs;

use App\Services\Bling\Enums\TypeOfContact;

class ContactDTO
{
    public function __construct(
        public string $name,
        public TypeOfContact $type = TypeOfContact::Physical
    ) {
    }

    public function toArray(): array
    {
        return [
            "nome" => $this->name,
            "tipo" => $this->type,
        ];
    }
}