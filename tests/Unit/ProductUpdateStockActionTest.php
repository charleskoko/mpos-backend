<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\User;
use Domain\Orders\Events\NewOrderCreatedEvent;
use Domain\Products\Events\UpdateProductStockEvent;
use Domain\Products\Listeners\UpdateProductStockListener;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductUpdateStockActionTest extends TestCase
{
    use RefreshDatabase;


    private User $authenticatedUser;
    private Product $existentProduct;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authenticatedUser = User::factory()->create();
        Sanctum::actingAs($this->authenticatedUser);
    }


   // public function UserCanCreateOrder()
   // {
   //     Event::fake([UpdateProductStockEvent::class]);

   //     $productOne = Product::factory()->create(['label' => 'product one', 'purchase_price' => '500', 'stock' => 10, 'sale_price' => 1000, 'user_id' => $this->authenticatedUser]);
   //     $productTwo = Product::factory()->create(['label' => 'product two', 'purchase_price' => '500', 'stock' => 10, 'sale_price' => 1000, 'user_id' => $this->authenticatedUser]);
   //     $productThree = Product::factory()->create(['label' => 'product three', 'purchase_price' => '500', 'stock' => 10, 'sale_price' => 1000, 'user_id' => $this->authenticatedUser]);

   //     $newOrderData = [
   //         'addOrderLineItem' => [
   //             [
   //                 'product_id' => $productOne->id,
   //                 'amount' => 5,
   //                 'price' => $productOne->purchase_price,
   //             ],
   //             [
   //                 'product_id' => $productTwo->id,
   //                 'amount' => 5,
   //                 'price' => $productTwo->purchase_price,
   //             ],
   //             [
   //                 'product_id' => $productThree->id,
   //                 'amount' => 5,
   //                 'price' => $productThree->purchase_price,
   //             ],
   //         ]
   //     ];
   //     $response = $this->post(route('orders.store'), $newOrderData);
   //     Event::assertListening(
   //         UpdateProductStockEvent::class,
   //         UpdateProductStockListener::class
   //     );
   //     $response->assertStatus(201);
       // $this->assertDatabaseHas('products', ['id' => $productOne->id, 'stock' => 5]);
       // $this->assertDatabaseHas('products', ['id' => $productTwo->id, 'stock' => 5]);
       // $this->assertDatabaseHas('products', ['id' => $productThree->id, 'stock' => 5]);
  //  }

}
