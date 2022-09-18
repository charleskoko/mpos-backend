<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderLineItem;
use App\Models\Product;
use App\Models\User;
use Domain\Orders\Events\NewOrderCreatedEvent;
use Domain\Orders\Listeners\NewOrderCreatedListener;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
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
            ]
        ];
        $response = $this->post(route('orders.store'), $newOrderData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('order_line_items', ['product_id' => $orderItemOneProduct, 'amount' => $orderItemOneAmount, 'price' => $orderItemOnePrice]);
    }

    public function testUserCanSeeHisOrder()
    {
        $response = $this->get(route('orders.index'));
        $response->assertStatus(200);
    }

  //  public function testUserCanDeleteOrder()
  //  {
  //      $order = Order::inRandomOrder()->first();
  //      $orderInfo = ['id' => $order->id, 'number' => $order->number, 'user_id' => $order->user_id];
  //      $response = $this->delete(route('orders.destroy', $order->id));
  //      $response->assertStatus(204);
  //      $this->assertDatabaseMissing('orders', $orderInfo);
  //      $this->assertDatabaseMissing('order_line_items', ['order_id' => $order->id]);
  //  }
}
