<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\Refund;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RefundControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function testUserStoreRefund()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $order = Order::factory()->create();
        $refundData = [
            'reason' => $this->faker->randomElement(Refund::REASONS),
            'amount_refunded' => rand(0, 100),
            'order_id' => $order->id,
        ];
        $response = $this->post(route('refund.store'), $refundData);
        $response->assertStatus(201);
    }

    public function testUserCannotSaveRefundWithoutReason()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $order = Order::factory()->create();
        $refundData = [
            'amount_refunded' => rand(0,100),
            'order_id' => $order->id,
        ];
        $response = $this->post(route('refund.store'), $refundData);
        $response->assertStatus(302);
    }
}
