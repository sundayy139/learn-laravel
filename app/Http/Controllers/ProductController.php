<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use PHPShopify\ShopifySDK;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $shopify;

    public function __construct(ShopifySDK $shopify)
    {
        $this->shopify = $shopify;
    }

    public function index()
    {
        $products = $this->shopify->Product->get();

        return new ProductCollection($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        
        $validated = $request->validated();

        $product = $this->shopify->Product->post($validated);

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show($product)
    {
        $productShow = $this->shopify->Product($product)->get();

        return new ProductResource($productShow);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $product)
    {
        $validated = $request->validated();

        $productUpdate = $this->shopify->Product($product)->put($validated);

        return new ProductResource($productUpdate);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product)
    {
        $this->shopify->Product($product)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ]);
    }
}
