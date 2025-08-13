<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    // Lấy tất cả đơn hàng của user
    public function index()
    {
        $orders = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->get();
        return response()->json($orders);
    }

    // Tạo đơn hàng từ giỏ hàng
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'phone' => 'required|string'
        ]);

        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Cart is empty'], 400);
        }

        $totalPrice = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $totalPrice,
            'status' => 'pending',
            'shipping_address' => $request->shipping_address,
            'phone' => $request->phone
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);
        }

        // Xóa giỏ hàng sau khi đặt hàng
        Cart::where('user_id', Auth::id())->delete();

        return response()->json($order->load('items.product'), 201);
    }

    // Xem chi tiết đơn hàng
    public function show($id)
    {
        $order = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return response()->json($order);
    }

    // Admin cập nhật trạng thái đơn hàng
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,shipped,completed,canceled'
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return response()->json($order);
    }
}
