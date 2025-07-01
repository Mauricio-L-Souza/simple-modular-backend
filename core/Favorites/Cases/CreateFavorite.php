<?php

namespace Core\Favorites\Cases;

use Exception;
use App\Models\CustomerFavorite;
use App\Exceptions\FavoriteProductException;
use Core\Favorites\Clients\FavoriteProductClient;
use Core\Favorites\Payloads\CustomerFavoritePayload;

class CreateFavorite
{
    function __construct(
        private FavoriteProductClient $productClient,
        private CheckProductFavoriteExists $favoriteAlreadyExistChecker
    ) {}

    public function execute(CustomerFavoritePayload $payload)
    {
        $product = $this->checkProductIsAvailable($payload->productID);
        $this->favoriteAlreadyExistChecker->execute($payload);

        return CustomerFavorite::create([
            'title' => $product->name,
            'thumb_url' => $product->imageUrl,
            'product_id' => $payload->productID,
            'customer_id' => $payload->customerID,
        ]);
    }

    private function checkProductIsAvailable(int $productID)
    {
        try {
            return $this->productClient->findExternalProduct($productID);
        } catch (Exception $ex) {
            throw FavoriteProductException::invalidProductProvided();
        }
    }
}
