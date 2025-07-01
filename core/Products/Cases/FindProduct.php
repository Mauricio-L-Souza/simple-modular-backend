<?php

namespace Core\Products\Cases;

use Core\Products\Clients\ProductHttpClient;
use Core\Products\DTOs\ProductDTO;

class FindProduct
{
    function __construct(private ProductHttpClient $client) {}

    public function execute(int $productID)
    {
        $product = $this->client->find($productID);
        dd($product);
        return $this->transform($product);
    }

    private function transform(ProductDTO $product)
    {

        return [
            "id" => $product->id,
            "title" => $product->name,
            "price" => $product->price,
            "image" => $product->imageUrl,
            "description" => $product->description,
            "rating" => [
                "rate" => $product->rate,
                "count" => $product->rateCount
            ]
        ];
    }
}
