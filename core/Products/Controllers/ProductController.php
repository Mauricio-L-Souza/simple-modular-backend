<?php

namespace Core\Products\Controllers;

use App\Http\Controllers\Controller;
use Core\Products\Cases\FindProduct;
use Core\Products\Cases\ListProducts;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(ListProducts $case)
    {
        return $case->execute();
    }

    public function show(Request $request, FindProduct $case)
    {
        return $case->execute((int)$request->productID);
    }
}
