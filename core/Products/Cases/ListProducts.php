<?php

namespace Core\Products\Cases;

use Core\Products\Clients\ProductHttpClient;

class ListProducts
{
    function __construct(private ProductHttpClient $client) {}

    public function execute()
    {
        return $this->client->list();
    }
}
