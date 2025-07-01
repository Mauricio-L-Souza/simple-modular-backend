<?php

namespace Core\Favorites\Tests;

use Tests\TestCase;
use App\Models\Customer;
use App\Models\CustomerFavorite;
use Core\Products\DTOs\ProductDTO;
use Core\Favorites\Cases\FindFavorite;
use Core\Favorites\Clients\FavoriteProductClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Core\Favorites\Payloads\CustomerFavoritePayload;

class FindFavoriteTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_find_customer_favorite()
    {
        $customerID = Customer::factory()->create()->id;

        CustomerFavorite::factory()->create([
            'product_id' => 1,
            'customer_id' => $customerID,
            'title' => 'fake product 1',
            'thumb_url' => "https://fakeurl.com/img/fakeimage.jpg",
        ]);

        $this->mock(FavoriteProductClient::class)->shouldReceive('findExternalProduct')
            ->once()
            ->andReturn($this->findProductMockResponse());

        /** @var FindFavorite */
        $case = app(FindFavorite::class);
        $favorite = $case->execute(favoriteID: 1)->toArray();

        $this->assertEquals([
            'id' => 1,
            'product_id' => 1,
            'title' => 'fake product 1',
            'customer_id' => $customerID,
            'thumb_url' => "https://fakeurl.com/img/fakeimage.jpg",
            'created_at' => $favorite['created_at'],
            'updated_at' => $favorite['updated_at'],
            'rating' => [
                'rate' => 3.9,
                'count' => 120
            ],
        ], $favorite);
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
