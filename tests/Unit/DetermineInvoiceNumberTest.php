<?php

namespace Tests\Unit;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderLineItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DetermineInvoiceNumberTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private User $user;
    private Order $order;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        Product::factory()->create([
            'user_id' => $this->user->id
        ]);
        $this->order = Order::factory()->create(
            ['user_id' => $this->user->id]);
        OrderLineItem::factory()->create();
        Sanctum::actingAs($this->user);
    }

    private function createInvoices($user, $order)
    {
        $count = 1;
        while ($count < 10) {
            Invoice::factory()->create([
                'user_id' => $this->user->id,
                'order_id' => $this->order->id,
                'number' => $count,
                'created_at' => Carbon::yesterday()
            ]);
            $count++;
        }
    }


    public function testFirstInvoiceNumber()
    {
        $newOrderData = [
            'addOrderLineItem' => [
                [
                    'product_id' => Product::inRandomOrder()->first()->id,
                    'amount' => $this->faker->randomFloat(2, 100, 10000),
                    'price' => $this->faker->randomDigit(),
                ],
            ]
        ];
        $response = $this->post(route('orders.store'), $newOrderData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('invoices', ['number' => 1]);
    }


    public function testVerificationInvoiceNumberIncrementation()
    {

        $this->createInvoices($this->user, $this->order);
        $newOrderData = [
            'addOrderLineItem' => [
                [
                    'product_id' => Product::inRandomOrder()->first()->id,
                    'amount' => $this->faker->randomFloat(2, 100, 10000),
                    'price' => $this->faker->randomDigit(),
                ],
            ]
        ];
        $response = $this->post(route('orders.store'), $newOrderData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('invoices', ['number' => 10]);

    }


}
