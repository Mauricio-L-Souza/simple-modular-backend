<?php

namespace Core\Favorites\Tests;

use Tests\TestCase;
use App\Models\Customer;
use App\Models\CustomerFavorite;
use App\Exceptions\FavoriteProductException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Core\Favorites\Cases\CheckProductFavoriteExists;
use Core\Favorites\Payloads\CustomerFavoritePayload;

class CheckProductFavoriteExistsTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_check_customer_favorite_already_exists()
    {
        $customerID = Customer::factory()->create()->id;

        $payload = new CustomerFavoritePayload(
            customerID: $customerID,
            productID: 1
        );

        CustomerFavorite::factory()->create([
            'customer_id' => $payload->customerID,
            'product_id' => $payload->productID
        ]);

        /** @var CheckProductFavoriteExists */
        $case = app(CheckProductFavoriteExists::class);

        $this->expectException(FavoriteProductException::class);
        $this->expectExceptionMessage('Este produto já foi favoritado para este cliente');
        $case->execute($payload);
    }

    public function test_it_can_check_customer_favorite_not_exists()
    {
        $customerID = Customer::factory()->create()->id;

        $payload = new CustomerFavoritePayload(
            customerID: $customerID,
            productID: 1
        );

        /** @var CheckProductFavoriteExists */
        $case = app(CheckProductFavoriteExists::class);

        $this->assertDoesntThrow(fn() => $case->execute($payload));
    }
}
