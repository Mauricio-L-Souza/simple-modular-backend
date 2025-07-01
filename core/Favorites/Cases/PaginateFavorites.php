<?php

namespace Core\Favorites\Cases;

use App\Models\CustomerFavorite;

class PaginateFavorites
{
    public function execute(int $customerID, int $page, int $perPage)
    {
        return CustomerFavorite::where('customer_id', $customerID)
            ->paginate($perPage, ['*'], 'page', $page);
    }
}
