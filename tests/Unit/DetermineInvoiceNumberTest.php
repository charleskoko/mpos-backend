<?php

namespace Tests\Unit;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderLineItem;
use App\Models\Product;
use App\Models\UniqueNumber;
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

    private function createInvoices($user, $order,$number)
    {
        $count = 1;
        while ($count < $number) {
            Invoice::factory()->create([
                'user_id' => $this->user->id,
                'order_id' => $this->order->id,
                'number' => UniqueNumber::generateNumber('Invoice', $this->user->unique_number,$this->user->id,),
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
        $number = 'INV'.$this->user->unique_number.date('Y').'-00001';
        $this->assertDatabaseHas('invoices', ['number' => $number]);
    }


    public function testVerificationInvoiceNumberIncrementation()
    {

        $this->createInvoices($this->user, $this->order,10);
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
        $number = 'INV'.$this->user->unique_number.date('Y').'-00010';
        $this->assertDatabaseHas('invoices', ['number' => $number]);

    }


    public function testVerificationInvoiceNumberOtherUser(){
        $this->createInvoices($this->user, $this->order, 10);
        $newUser = User::factory()->create();
        $product = Product::factory()->create(
            ['user_id' => $newUser->id]
        );
        Sanctum::actingAs($newUser);
        $newOrderData = [
            'addOrderLineItem' => [
                [
                    'product_id' => $product->id,
                    'amount' => $this->faker->randomFloat(2, 100, 10000),
                    'price' => $this->faker->randomDigit(),
                ],
            ]
        ];
        $response = $this->post(route('orders.store'), $newOrderData);
        $response->assertStatus(201);
        $number = 'INV'.$newUser->unique_number.date('Y').'-00001';
        $this->assertDatabaseHas('invoices', ['number' => $number, 'user_id' => $newUser->id]);

    }


}
