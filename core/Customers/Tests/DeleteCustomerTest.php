<?php

namespace Core\Customers\Tests;

use Tests\TestCase;
use App\Models\Customer;
use Core\Customers\Cases\DeleteCustomer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteCustomerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_delete_customer()
    {
        /** @var DeleteCustomer */
        $case = app(DeleteCustomer::class);

        Customer::factory()->create([
            'name' => 'Fake customer',
            'email' => 'fakemail@mail.com'
        ]);

        $case->execute(customerID: 1);

        $this->assertDatabaseMissing('customers', [
            'id' => 1,
            'name' => 'Fake Customer',
            'email' => 'fakemail@mail.com'
        ]);
    }
}
