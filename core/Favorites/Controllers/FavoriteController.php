<?php

namespace Core\Favorites\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Core\Favorites\Cases\FindFavorite;
use Core\Favorites\Cases\CreateFavorite;
use Core\Favorites\Cases\DeleteFavorite;
use Core\Favorites\Cases\PaginateFavorites;
use Core\Favorites\Payloads\CustomerFavoritePayload;

class FavoriteController extends Controller
{
    public function index(Request $request, PaginateFavorites $case)
    {
        return $case->execute(
            customerID: (int)$request->customerID,
            page: $request->page ?? 1,
            perPage: $request->per_page ?? 10
        );
    }

    public function show(Request $request, FindFavorite $case)
    {
        return $case->execute((int)$request->favoriteID);
    }

    public function store(Request $request, CreateFavorite $case)
    {
        $data = $request->validate([
            'product_id' => 'required',
            'customer_id' => 'required'
        ]);

        return $case->execute(new CustomerFavoritePayload(
            customerID: $data['customer_id'],
            productID: $data['product_id']
        ));
    }

    public function destroy(Request $request, DeleteFavorite $case)
    {
        return $case->execute((int)$request->favoriteID);
    }
}
