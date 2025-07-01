<?php

namespace Core\Customers\Cases;

use App\Models\Customer;
use Core\Customers\Payloads\CustomerPayload;

class UpdateCustomer
{
    public function execute(int $customerID, CustomerPayload $payload)
    {
        /** @var Customer */
        $customer = Customer::findOrFail($customerID);

        $customer->update([
            'name' => $payload->name,
        ]);

        return $customer->refresh();
    }
}
