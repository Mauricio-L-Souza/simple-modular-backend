<?php

namespace Core\Customers\Cases;

use App\Models\Customer;
use App\Exceptions\CustomerException;
use Core\Customers\Payloads\CustomerPayload;

class CreateCustomer
{
    public function execute(CustomerPayload $payload)
    {
        if ($this->customerAlreadyExists($payload->email)) {
            throw CustomerException::customerEmailAlreadyExists();
        }

        return Customer::create([
            'name' => $payload->name,
            'email' => $payload->email
        ]);
    }

    private function customerAlreadyExists(string $email)
    {
        return Customer::where('email', $email)->exists();
    }
}
