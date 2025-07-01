<?php

namespace Core\Favorites\Cases;

use App\Models\CustomerFavorite;

class DeleteFavorite
{
    public function execute(int $favoriteID)
    {
        return ['deleted' => CustomerFavorite::findOrFail($favoriteID)->delete()];
    }
}
