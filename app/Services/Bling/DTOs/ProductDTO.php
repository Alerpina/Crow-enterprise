<?php

namespace App\Services\Bling\DTOs;

use App\Services\Bling\Enums\Format;
use App\Services\Bling\Enums\Measurement;
use App\Services\Bling\Enums\Status;
use App\Services\Bling\Enums\Type;

class ProductDTO
{
    public function __construct(
        public ?int $id = null,
        public string $name,
        public float $price,
        public ?string $code = null,
        public ?string $description = null,
        public ?float $weight = null,
        public ?string $brand = null,
        public ?int $category = null,
        public ?float $width = null,
        public ?float $height = null,
        public ?float $length = null,
        public ?string $image = null,
        public Type $type = Type::Product,
        public Status $status = Status::Active,
        public Format $format = Format::Simple,
        public Measurement $measurement = Measurement::Centimeter,
    ) {
    }

    public function toArray(): array
    {
        $data = [
            'nome' => $this->name,
            'preco' => round($this->price, 2),
            'tipo' => $this->type->value,
            'situacao' => $this->status->value,
            'formato' => $this->format->value,
            'unidade' => 'UN',
        ];

        if ($this->id) {
            $data['id'] = $this->id;
        }

        if ($this->code) {
            $data['codigo'] = $this->code;
        }

        if ($this->description) {
            $data['descricaoCurta'] = $this->description;
        }

        if ($this->weight) {
            $data['pesoBruto'] = $this->weight;
        }

        if ($this->brand) {
            $data['marca'] = $this->brand;
        }

        if ($this->category) {
            $data['categoria']['id'] = $this->category;
        }

        if ($this->width) {
            $data['dimensoes']['largura'] = $this->width;
        }

        if ($this->height) {
            $data['dimensoes']['altura'] = $this->height;
        }

        if ($this->length) {
            $data['dimensoes']['profundidade'] = $this->length;
        }

        if ($this->measurement->value) {
            $data['dimensoes']['unidadeMedida'] = $this->measurement->value;
        }        

        if ($this->image) {
            $data['midia']['imagens']['externas'][0]['link'] = $this->image;
        }

        return $data;
    }
}
