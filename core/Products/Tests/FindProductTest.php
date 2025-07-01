<?php

namespace Core\Products\Tests;

use Tests\TestCase;
use Core\Products\DTOs\ProductDTO;
use Core\Products\Cases\FindProduct;
use Core\Products\Clients\ProductHttpClient;

class FindProductTest extends TestCase
{
    public function test_it_can_find_product()
    {
        $this->mock(ProductHttpClient::class)->shouldReceive('find')
            ->once()
            ->andReturn($this->findMockResponse());

        /** @var FindProduct */
        $case = app(FindProduct::class);

        $product = $case->execute(productID: 1);

        $this->assertEquals([
            "id" => 1,
            "title" => "fake product 1",
            "price" => 109.95,
            "description" => "Lorem Ipsum 1",
            "image" => "https://fakeurl.com/img/fakeimage.jpg",
            "rating" => [
                "rate" => 3.9,
                "count" => 120
            ]
        ], $product);
    }

    private function findMockResponse()
    {
        return new ProductDTO(
            id: 1,
            rate: 3.9,
            name: "fake product 1",
            price: 109.95,
            rateCount: 120,
            description: "Lorem Ipsum 1",
            imageUrl: "https://fakeurl.com/img/fakeimage.jpg",
        );
    }
}
