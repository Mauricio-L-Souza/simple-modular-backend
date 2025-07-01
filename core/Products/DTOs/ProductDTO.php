<?php

namespace Core\Products\DTOs;

class ProductDTO
{
    function __construct(
        public int $id,
        public ?float $rate,
        public string $name,
        public float $price,
        public string $imageUrl,
        public ?float $rateCount,
        public string $description,
    ) {}
}
