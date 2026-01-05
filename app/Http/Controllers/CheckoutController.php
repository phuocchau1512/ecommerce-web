<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Hiển thị trang thanh toán
     */
    public function index()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Giỏ hàng trống');
        }

        return view('checkout');
    }

    /**
     * Xử lý đặt hàng
     */
    public function placeOrder(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Giỏ hàng trống');
        }

        // VALIDATE FORM
        $request->validate([
            'name'           => 'required|string|max:255',
            'phone'          => 'required|string|max:20',
            'email'          => 'nullable|email',
            'address'        => 'required|string|max:255',
            'payment_method' => 'required|in:bank,cod',
        ]);


        DB::beginTransaction();

        try {
            /**
             * 1️⃣ TẠO ĐƠN HÀNG
             */
            $order = Order::create([
                'user_id'          => Auth::id(), // null nếu guest
                'customer_name'    => $request->name,
                'customer_phone'   => $request->phone,
                'customer_email'   => $request->email,
                'customer_address' => $request->address,
                'payment_method'   => $request->payment_method,
                'total_amount'     => 0,
                'status'           => 'pending',
            ]);

            $total = 0;

            /**
             * 2️⃣ TẠO ORDER ITEMS + TRỪ KHO (THEO VARIANT)
             */
            foreach ($cart as $item) {

                // lockForUpdate để tránh âm kho
                $variant = ProductVariant::with('product')
                    ->lockForUpdate()
                    ->findOrFail($item['variant_id']);

                if ($item['quantity'] > $variant->stock) {
                    throw new \Exception(
                        'Sản phẩm "' . $variant->product->name . '" không đủ tồn kho'
                    );
                }

                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $variant->product_id,
                    'variant_id'   => $variant->id,

                    // snapshot dữ liệu tại thời điểm mua
                    'product_name' => $variant->product->name,
                    'variant_name' => $variant->variant_name,

                    'quantity'     => $item['quantity'],
                    'price'        => $variant->price,
                ]);

                // trừ kho
                $variant->decrement('stock', $item['quantity']);

                // cộng tiền
                $total += $variant->price * $item['quantity'];
            }

            /**
             * 3️⃣ CẬP NHẬT TỔNG TIỀN
             */
            $order->update([
                'total_amount' => $total
            ]);

            /**
             * 4️⃣ XÓA GIỎ HÀNG
             */
            session()->forget('cart');

            DB::commit();

            return redirect()->route('checkout.success', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Trang đặt hàng thành công
     */
    public function success(Order $order)
    {
        // load items luôn cho view
        $order->load('items');

        return view('checkout-success', compact('order'));
    }
}
