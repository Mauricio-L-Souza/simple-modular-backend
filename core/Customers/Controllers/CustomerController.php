<?php

namespace Core\Customers\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Core\Customers\Cases\FindCustomer;
use Core\Customers\Cases\CreateCustomer;
use Core\Customers\Cases\DeleteCustomer;
use Core\Customers\Cases\UpdateCustomer;
use Core\Customers\Payloads\CustomerPayload;

class CustomerController extends Controller
{
    public function show(Request $request, FindCustomer $case)
    {
        return $case->execute((int)$request->customerID);
    }

    public function store(Request $request, CreateCustomer $case)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        return $case->execute(new CustomerPayload(
            name: $data['name'],
            email: $data['email']
        ));
    }

    public function update(Request $request, UpdateCustomer $case)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        return $case->execute(
            customerID: (int)$request->customerID,
            payload: new CustomerPayload(
                name: $data['name'],
                email: $data['email']
            )
        );
    }

    public function delete(Request $request, DeleteCustomer $case)
    {
        return $case->execute((int)$request->customerID);
    }
}
