<?php

namespace Core\Customers\Payloads;

class CustomerPayload
{
    function __construct(
        public string $name,
        public string $email
    ) {}
}
