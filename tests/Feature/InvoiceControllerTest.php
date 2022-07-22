<?php

namespace Tests\Feature;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderLineItem;
use App\Models\Product;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class InvoiceControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        Product::factory()->create([
            'user_id' => $user->id
        ]);
        $order = Order::factory()->create(
            ['user_id' => $user->id]);
        OrderLineItem::factory()->create();
        Invoice::factory()->create([
            'user_id' => $user->id,
            'order_id' => $order->id
        ]);
        Sanctum::actingAs($user);
    }

    public function testUserCanSeeHisInvoiceList()
    {
        $response = $this->get(route('invoices.index'));
        $response->assertStatus(200);
    }

    public function testUserCanSeeAnInvoice()
    {
        $invoice = Invoice::factory()->create();
        $response = $this->get(route('invoices.show',$invoice->id));
        $response->assertStatus(200);
    }

    public function testUserCanDeleteAnInvoice()
    {
        $invoice = Invoice::factory()->create();
        $response = $this->delete(route('invoices.destroy',$invoice->id));
        $response->assertStatus(204);
    }
}
