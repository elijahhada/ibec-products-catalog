<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyStoreRequest;
use App\Http\Resources\PropertiesResource;
use App\Models\Property;
use Illuminate\Support\Facades\DB;

class PropertiesController extends Controller
{
    public function store(PropertyStoreRequest $request)
    {
        Property::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Property was created',
        ], 201);
    }

    public function remove(Property $property)
    {
        DB::table('product_property')->where('property_id', $property->id)->delete();
        $property->delete();

        return response()->noContent();
    }

    public function list()
    {
        return PropertiesResource::collection(Property::paginate(10));
    }
}
