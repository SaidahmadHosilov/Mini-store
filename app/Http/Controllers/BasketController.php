<?php
// app/Http/Controllers/BasketController.php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{
    /**
     * Add a product to the user's basket (draft order).
     */
    public function addToBasket(Request $request, $productId)
    {
        // Validate that the product exists
        $product = Product::findOrFail($productId);

        // Check if the user is logged in
        $user = Auth::user();

        // Check if the product already exists in the user's basket (draft)
        $existingBasketItem = Basket::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->where('status', 'draft')
            ->first();

        if ($existingBasketItem) {
            // If the product already exists, update the quantity
            $existingBasketItem->quantity += $request->input('quantity', 1);
            $existingBasketItem->save();
        } else {
            // Otherwise, create a new basket item
            Basket::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => $request->input('quantity', 1),
                'status' => 'draft',
            ]);
        }

        return redirect()->back()->with('success', 'Mahsulot savatchaga qo\'shildi');
    }

    /**
     * Get the current user's basket (draft orders).
     */
    public function getBasket()
    {
        $user = Auth::user();

        $basketItems = Basket::with('product')
            ->where('user_id', $user->id)
            ->where('status', 'draft')
            ->get();

        return view('basket.index', compact('basketItems'));
    }

    public function updateBasket(Request $request)
    {
        $user = Auth::user();
        $quantities = $request->input('quantities', []);

        foreach ($quantities as $basketId => $qty) {
            $basketItem = Basket::where('id', $basketId)->where('user_id', $user->id)->first();
            if ($basketItem && $qty > 0) {
                $basketItem->quantity = $qty;
                $basketItem->save();
            }
        }

        return redirect()->route('basket.index')->with('success', 'Savatcha yangilandi.');
    }

    public function removeFromBasket($id)
    {
        $user = Auth::user();
        $basketItem = Basket::where('id', $id)->where('user_id', $user->id)->firstOrFail();
        $basketItem->delete();

        return redirect()->route('basket.index')->with('success', 'Mahsulot savatchadan olib tashlandi.');
    }


    public function checkout(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'payment_method' => 'required|in:cash,card,transfer',
            'payment_amount' => 'required|numeric|min:0.01',
        ]);

        $paymentAmountFromUser = round($validated['payment_amount'], 2);

        $baskets = Basket::where('user_id', $user->id)
            ->where('status', 'draft')
            ->get();

        if ($baskets->isEmpty()) {
            return redirect()->back()->with('error', 'Savatchangiz bo‘sh.');
        }

        // Real narxni hisoblaymiz (product narxi * miqdor)
        $calculatedTotal = $baskets->sum(function ($item) {
            return round($item->product->price * $item->quantity, 2);
        });

        // Agar yuborilgan narx noto‘g‘ri bo‘lsa
        if ($paymentAmountFromUser != $calculatedTotal) {
            return redirect()->back()->with('error', 'To‘lov summasi noto‘g‘ri. Iltimos, sahifani yangilang.');
        }

        DB::beginTransaction();

        try {
            $payment = Payment::create([
                'user_id' => $user->id,
                'amount' => $paymentAmountFromUser,
                'method' => $validated['payment_method'],
            ]);

            $order = Order::create([
                'user_id' => $user->id,
                'payment_id' => $payment->id,
                'total_amount' => $paymentAmountFromUser,
                'status' => 'pending',
            ]);

            foreach ($baskets as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                // Mahsulot zaxirasini kamaytirish
                $product = $item->product;
                $product->stock_quantity -= $item->quantity;

                // Manfiy bo‘lmasligi uchun tekshiramiz
                if ($product->stock_quantity < 0) {
                    return back()->with('error', "Mahsulot zaxirasi yetarli emas: {$product->name}");
                }

                $product->save();
            }

            Basket::where('user_id', $user->id)->where('status', 'draft')->delete();

            DB::commit();

            return redirect()->route('basket.index')->with('success', 'Zakaz muvaffaqiyatli rasmiylashtirildi!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Xatolik: ' . $e->getMessage());
        }
    }
}
