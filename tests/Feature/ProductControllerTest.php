<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $authenticatedUser;
    private Product $existentProduct;

    protected function setUp(): void
    {
        parent::setUp();
        $this->authenticatedUser = User::factory()->create();
        $this->existentProduct = Product::factory()->create(['label' => 'existent product', 'price' => 1000, 'user_id' => $this->authenticatedUser]);
        Sanctum::actingAs($this->authenticatedUser);
    }


    public function testUserCanSeeHisProductList()
    {
        Product::factory()->create(['user_id' => $this->authenticatedUser->id]);
        $response = $this->get(route('products.index'));
        $response->assertStatus(200);
    }

    public function testUserCanStoreNewProduct()
    {
        $productData = ['label' => 'new product', 'price' => 1000];
        $response = $this->post(route('products.store'), $productData);
        $response->assertStatus(201);
        $this->assertDatabaseHas('products', $productData);
    }

    public function testUserCanUpdateProductInfo()
    {
        $newExistentProductInfo = ['label' => 'update label', 'price' => 2500];
        $response = $this->patch(route('products.update',$this->existentProduct->id),$newExistentProductInfo);
        $response->assertStatus(200);
        $this->assertDatabaseHas('products', $newExistentProductInfo);
        $this->assertDatabaseMissing('products',['label' => 'existent product', 'price' => 1000]);
    }

    public function testUserCanDeleteProduct()
    {
        $response = $this->delete(route('products.destroy',$this->existentProduct->id));
        $response->assertStatus(204);
        $this->assertDatabaseMissing('products',['label' => 'existent product', 'price' => 1000]);
    }
}