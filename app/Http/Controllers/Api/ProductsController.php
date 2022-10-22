<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchProductsRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductsController extends Controller
{
    public function bySlug(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

    public function search(SearchProductsRequest $request)
    {
        $requestInputs = $request->all();
        $query = Product::query();

        if (isset($request->categories)) {
            $query->whereHas('category', function ($innerQuery) use ($requestInputs) {
                $innerQuery->whereIn('id', $requestInputs['categories']);
            });
        }
        if (isset($request->price)) {
            $query->where('price', $requestInputs['price']);
        }
        if (isset($request->properties)) {
            foreach ($requestInputs['properties'] as $property) {
                $query->whereHas('properties', function ($innerQuery) use ($requestInputs, $property) {
                    $innerQuery->where('title', $property['title']);
                    $innerQuery->where('value', $property['value']);
                });
            }
        }

        return ProductResource::collection($query->get());
    }
}
