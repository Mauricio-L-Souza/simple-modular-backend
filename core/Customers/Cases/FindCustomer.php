<?php

namespace Core\Customers\Cases;

use App\Models\Customer;

class FindCustomer
{
    public function execute(int $customerID): Customer
    {
        return Customer::findOrFail($customerID);
    }
}
