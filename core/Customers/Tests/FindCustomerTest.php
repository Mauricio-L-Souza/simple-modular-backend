<?php

namespace Core\Customers\Tests;

use Tests\TestCase;
use App\Models\Customer;
use Core\Customers\Cases\FindCustomer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FindCustomerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_find_customer()
    {
        /** @var FindCustomer */
        $case = app(FindCustomer::class);

        Customer::factory()->create([
            'name' => 'Fake customer',
            'email' => 'fakemail@mail.com'
        ]);

        $customer = $case->execute(customerID: 1);

        $this->assertInstanceOf(Customer::class, $customer);

        $this->assertEquals(1, $customer->id);
        $this->assertEquals('Fake customer', $customer->name);
        $this->assertEquals('fakemail@mail.com', $customer->email);
    }
}
