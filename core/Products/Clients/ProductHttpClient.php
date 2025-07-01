<?php

namespace Core\Products\Clients;

use Core\Products\DTOs\ProductDTO;
use Illuminate\Support\Facades\Http;
use Core\Products\Exceptions\ProductHttpClientException;

class ProductHttpClient
{
    private string $baseURL;

    function __construct()
    {
        $this->baseURL = config('services.fake_store.base_url', "");
        $this->validateUrl();
    }

    public function list(): array
    {
        return Http::get("{$this->baseURL}/products")->json();
    }

    public function find(int $id): ProductDTO
    {
        $product = Http::get("{$this->baseURL}/products/{$id}")->json();

        return new ProductDTO(
            id: $product['id'],
            name: $product['title'],
            price: $product['price'],
            imageUrl: $product['image'],
            description: $product['description'],
            rate: $product['rating']['rate'] ?? null,
            rateCount: $product['rating']['count'] ?? null,
        );
    }

    private function validateUrl()
    {
        if (!$this->baseURL) {
            throw ProductHttpClientException::serviceBaseUrlNotSetted();
        }
    }
}
