<?php

namespace Core\Favorites\Payloads;

class CustomerFavoritePayload
{
    function __construct(public int $customerID, public int $productID) {}
}
