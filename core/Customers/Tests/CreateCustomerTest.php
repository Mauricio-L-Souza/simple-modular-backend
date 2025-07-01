<?php

namespace Core\Customers\Tests;

use Tests\TestCase;
use Core\Customers\Cases\CreateCustomer;
use Core\Customers\Payloads\CustomerPayload;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCustomerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_create_customer()
    {
        /** @var CreateCustomer */
        $case = app(CreateCustomer::class);

        $payload = new CustomerPayload(
            name: 'Fake Customer',
            email: 'fakemail@mail.com'
        );
        $case->execute($payload);

        $this->assertDatabaseHas('customers', [
            'id' => 1,
            'name' => 'Fake Customer',
            'email' => 'fakemail@mail.com'
        ]);
    }
}
