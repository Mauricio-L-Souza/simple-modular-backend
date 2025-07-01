<?php

namespace Core\Customers\Tests;

use App\Models\Customer;
use Tests\TestCase;
use Core\Customers\Cases\UpdateCustomer;
use Core\Customers\Payloads\CustomerPayload;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateCustomerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_update_customer()
    {
        /** @var UpdateCustomer */
        $case = app(UpdateCustomer::class);

        Customer::factory()->create([
            'name' => 'Fake customer',
            'email' => 'fakemail@mail.com'
        ]);

        $payload = new CustomerPayload(
            name: 'Fake Customer [changed]',
            email: 'fakemail@mail.com'
        );
        $case->execute(1, $payload);

        $this->assertDatabaseHas('customers', [
            'id' => 1,
            'name' => 'Fake Customer [changed]',
            'email' => 'fakemail@mail.com'
        ]);
    }
}
