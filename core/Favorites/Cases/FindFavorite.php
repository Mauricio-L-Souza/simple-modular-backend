<?php

namespace Core\Favorites\Cases;

use App\Models\CustomerFavorite;
use Core\Favorites\Clients\FavoriteProductClient;

class FindFavorite
{
    function __construct(
        private FavoriteProductClient $productClient,
        private CheckProductFavoriteExists $favoriteAlreadyExistChecker
    ) {}

    public function execute(int $favoriteID)
    {
        $favorite = CustomerFavorite::findOrFail($favoriteID);
        $product = $this->getProductData($favorite->product_id);

        $favorite->rating = [
            'rate' => $product->rate,
            'count' => $product->rateCount
        ];

        return $favorite;
    }

    private function getProductData(int $productID)
    {
        return $this->productClient->findExternalProduct($productID);
    }
}
