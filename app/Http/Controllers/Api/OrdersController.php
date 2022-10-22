<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PayOrderRequest;
use App\Http\Requests\StoreCartItemRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Http\Resources\OrderResource;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function addToCart(StoreCartItemRequest $request)
    {
        $requestInputs = $request->all();

        if (isset($requestInputs['order_id']) && Order::where('id', $requestInputs['order_id'])->first()) {
            CartItem::create($requestInputs);
        } else {
            $order = new Order();
            $order->save();
            $requestInputs['order_id'] = $order->id;
            CartItem::create($requestInputs);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item was added',
        ], 201);
    }

    public function updateItem(UpdateCartItemRequest $request, CartItem $item)
    {
        $item->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Item was updated',
        ]);
    }

    public function removeItem(CartItem $item)
    {
        if ($item->order->items()->count() === 1) {
            $item->order->delete();
        } else {
            $item->delete();
        }

        return response()->noContent();
    }

    public function payOrder(PayOrderRequest $request, Order $order)
    {
        $order->is_paid = true;
        $order->email = $request->user('sanctum')->email ?? $request->input('email');
        $order->phone = $request->user('sanctum')->phone ?? $request->input('phone');
        $order->name = $request->user('sanctum')->name ?? $request->input('name');
        $order->address = $request->user('sanctum')->address ?? $request->input('address');
        $order->user_id = $request->user('sanctum')->id ?? null;
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Order was payed',
        ]);
    }

    public function list()
    {
        return OrderResource::collection(Auth::user()->orders);
    }
}