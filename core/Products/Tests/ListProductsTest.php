<?php

namespace Core\Products\Tests;

use Tests\TestCase;
use Core\Products\Cases\ListProducts;
use Core\Products\Clients\ProductHttpClient;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListProductsTest extends TestCase
{
    public function test_it_can_list_product()
    {
        $this->mock(ProductHttpClient::class)->shouldReceive('list')
            ->once()
            ->andReturn($this->listMockResponse());

        /** @var ListProducts */
        $case = app(ListProducts::class);

        $products = $case->execute();

        $this->assertEquals([
            "id" => 1,
            "title" => "fake product 1",
            "price" => 109.95,
            "description" => "Lorem Ipsum 1",
            "category" => "test",
            "image" => "https://fakeurl.com/img/fakeimage.jpg",
            "rating" => [
                "rate" => 3.9,
                "count" => 120
            ]
        ], $products[0]);
    }

    private function listMockResponse()
    {
        return [
            [
                "id" => 1,
                "title" => "fake product 1",
                "price" => 109.95,
                "description" => "Lorem Ipsum 1",
                "category" => "test",
                "image" => "https://fakeurl.com/img/fakeimage.jpg",
                "rating" => [
                    "rate" => 3.9,
                    "count" => 120
                ]
            ],
            [
                "id" => 2,
                "title" => "fake product 2",
                "price" => 22.3,
                "description" => "Lorem Ipsum 2",
                "category" => "men's clothing",
                "image" => "https://fakeurl.com/img/fakeimage.jpg",
                "rating" => [
                    "rate" => 4.1,
                    "count" => 259
                ]
            ]
        ];
    }
}
