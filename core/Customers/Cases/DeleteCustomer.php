<?php

namespace Core\Customers\Cases;

use App\Models\Customer;

class DeleteCustomer
{
    public function execute(int $customerID): array
    {
        return ['deleted' => Customer::findOrFail($customerID)->delete()];
    }
}
