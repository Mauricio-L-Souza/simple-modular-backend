<?php

namespace Core\Favorites\Clients;

use Core\Products\Clients\ProductHttpClient;

class FavoriteProductClient
{
    public function findExternalProduct(int $productID)
    {
        return app(ProductHttpClient::class)->find($productID);
    }
}
