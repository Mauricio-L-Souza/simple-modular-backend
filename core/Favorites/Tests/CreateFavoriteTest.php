<?php

namespace Core\Favorites\Tests;

use Tests\TestCase;
use App\Models\Customer;
use Core\Favorites\Cases\CreateFavorite;
use Core\Favorites\Clients\FavoriteProductClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Core\Favorites\Payloads\CustomerFavoritePayload;
use Core\Products\DTOs\ProductDTO;

class CreateFavoriteTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_customer_favorite()
    {
        $customerID = Customer::factory()->create()->id;

        $payload = new CustomerFavoritePayload(
            customerID: $customerID,
            productID: 1
        );

        $this->mock(FavoriteProductClient::class)->shouldReceive('findExternalProduct')
            ->once()
            ->andReturn($this->findProductMockResponse());

        /** @var CreateFavorite */
        $case = app(CreateFavorite::class);
        $case->execute($payload);

        $this->assertDatabaseHas('customer_favorites', [
            'product_id' => 1,
            'customer_id' => $customerID,
            'title' => 'fake product 1',
            'thumb_url' => "https://fakeurl.com/img/fakeimage.jpg",
        ]);
    }

    private function findProductMockResponse()
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
