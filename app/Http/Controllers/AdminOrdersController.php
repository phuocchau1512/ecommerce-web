<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrdersController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('items')
            ->when($request->search, function ($q) use ($request) {
                $q->where('id', $request->search)
                ->orWhere('customer_name', 'like', "%{$request->search}%")
                ->orWhere('customer_phone', 'like', "%{$request->search}%");
            })
            ->when($request->status, function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString(); // ⭐ giữ filter khi paginate

        return view('admin.orders', compact('orders'));
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,shipping,completed'
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return response()->json([
            'success' => true
        ]);
    }



    public function destroy($id)
    {
        Order::findOrFail($id)->delete();
        return back()->with('success', 'Đã xoá đơn hàng');
    }
}
