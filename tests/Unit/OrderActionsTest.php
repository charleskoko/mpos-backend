<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\OrderLineItem;
use App\Models\Product;
use App\Models\User;
use Domain\Orders\Actions\DetermineOrderNumberAction;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class OrderActionsTest extends TestCase
{

    public function testUserCreateFirstOrder()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        Product::factory()->create(['user_id' => $user->id]);
        $determineOrderNumberAction = new DetermineOrderNumberAction();
        $orderNumber = ($determineOrderNumberAction)();
        $this->assertEquals(1, $orderNumber);
    }

    public function testNumberOfUserNewOneOrder()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        Product::factory()->create(['user_id' => $user->id]);
        Order::factory()->create(['number' => 1, 'user_id' => $user->id]);
        OrderLineItem::factory()->create();
        $determineOrderNumberAction = new DetermineOrderNumberAction();
        $orderNumber = ($determineOrderNumberAction)();
        $this->assertEquals(2, $orderNumber);
    }

    public function testIfOtherUserAddNewOrder()
    {
        $userOne = User::factory()->create();
        $userTwo = User::factory()->create();
        Product::factory()->create(['user_id' => $userOne->id]);
        Product::factory()->create(['user_id' => $userTwo->id]);
        Order::factory()->create(['number' => 5, 'user_id' => $userOne->id]);
        Order::factory()->create(['number' => 10, 'user_id' => $userTwo->id]);
        OrderLineItem::factory(2)->create();
        Sanctum::actingAs($userOne);
        $determineOrderNumberAction = new DetermineOrderNumberAction();
        $orderNumber = ($determineOrderNumberAction)();
        $this->assertEquals(6, $orderNumber);
    }
}
