<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductPostRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\ApiResponse;
use Domain\Products\Actions\CreateProductAction;
use Domain\Products\DataTransferObjects\ProductData;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    use ApiResponse;

    public CreateProductAction $createProductAction;

    public function __construct(CreateProductAction $createProductAction)
    {
        $this->createProductAction = $createProductAction;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $authUser = Auth::user();

        $authUserProduct = $authUser->products;

        return $this->success(['products' => $authUserProduct],);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductPostRequest $request
     * @return JsonResponse
     */
    public function store(ProductPostRequest $request): JsonResponse
    {
        $newProductValidatedData = $request->validated();
        $newProductDto = ProductData::fromRequest($newProductValidatedData);
        $newProductCreated = ($this->createProductAction)($newProductDto);

        return $this->success([ProductResource::make($newProductCreated)], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return $this->success(['product' => ProductResource::make($product)]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ProductPostRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(ProductPostRequest $request, Product $product): JsonResponse
    {
        $productValidatedNewData = $request->validated();
        $product->update($productValidatedNewData);

        return $this->success(['product' => $product->refresh()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return $this->success([], 204);
    }
}
