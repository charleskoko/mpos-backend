<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderLineItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        Product::factory(10)->create(['user_id' => $user->id]);
        Order::factory(10)->create(['user_id' => $user->id]);
        OrderLineItem::factory(10)->create();
    }

    public function testUserCanCreateOrder()
    {
        $newOrderData = [
            'addOrderLineItem' => [
                [
                    'product_id' => $orderItemOneProduct = Product::inRandomOrder()->first()->id,
                    'amount' => $orderItemOneAmount = $this->faker->randomFloat(2, 100, 10000),
                    'price' => $orderItemOnePrice = $this->faker->randomDigit(),
                ],
                [
                    'product_id' => $orderItemTwoProduct = Product::inRandomOrder()->first()->id,
                    'amount' => $orderItemTwoAmount = $this->faker->randomFloat(2, 100, 10000),
                    'price' => $orderItemTwoPrice = $this->faker->randomDigit(),
                ],
                [
                    'product_id' => $orderItemThreeProduct = Product::inRandomOrder()->first()->id,
                    'amount' => $orderItemThreeAmount = $this->faker->randomFloat(2, 100, 10000),
                    'price' => $orderItemThreePrice = $this->faker->randomDigit(),
                ],
                [
                    'product_id' => $orderItemFourProduct = Product::inRandomOrder()->first()->id,
                    'amount' => $orderItemFourAmount = $this->faker->randomFloat(2, 100, 10000),
                    'price' => $orderItemFourPrice = $this->faker->randomDigit(),
                ]
            ]
        ];

        $response = $this->post(route('orders.store'), $newOrderData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('order_line_items', ['product_id' => $orderItemOneProduct, 'amount' => $orderItemOneAmount, 'price' => $orderItemOnePrice]);
        $this->assertDatabaseHas('order_line_items', ['product_id' => $orderItemTwoProduct, 'amount' => $orderItemTwoAmount, 'price' => $orderItemTwoPrice]);
        $this->assertDatabaseHas('order_line_items', ['product_id' => $orderItemThreeProduct, 'amount' => $orderItemThreeAmount, 'price' => $orderItemThreePrice]);
        $this->assertDatabaseHas('order_line_items', ['product_id' => $orderItemFourProduct, 'amount' => $orderItemFourAmount, 'price' => $orderItemFourPrice]);
    }

    public function testUserCanSeeHisOrder()
    {
        $response = $this->get(route('orders.index'));
        $response->assertStatus(200);
        $this->assertDatabaseCount('orders', 10);
    }

    public function testUserCanDeleteOrder()
    {
        $order = Order::inRandomOrder()->first();
        $orderInfo = ['id' => $order->id, 'number' => $order->number, 'user_id' => $order->user_id];
        $response = $this->delete(route('orders.destroy', $order->id));
        $response->assertStatus(204);
        $this->assertDatabaseMissing('orders', $orderInfo);
        $this->assertDatabaseMissing('order_line_items', ['order_id' => $order->id]);
    }
}
