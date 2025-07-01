<?php

namespace Core\Favorites\Cases;

use App\Models\CustomerFavorite;
use App\Exceptions\FavoriteProductException;
use Core\Favorites\Payloads\CustomerFavoritePayload;

class CheckProductFavoriteExists
{
    public function execute(CustomerFavoritePayload $payload)
    {
        $favoriteAlreadyExists = CustomerFavorite::where('customer_id', $payload->customerID)
            ->where('product_id', $payload->productID)
            ->exists();

        if ($favoriteAlreadyExists) {
            throw FavoriteProductException::customerFavoriteAlreadyExists();
        }
    }
}
