<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $latestProducts = Product::paginate(4);
        $products = Product::paginate(12);

        $basketCount = 0;

        if (Auth::check()) {
            $basketCount = Basket::where('user_id', Auth::id())
                ->where('status', 'draft')
                ->sum('quantity');  // Yoki ->count() agar har bir itemni 1 deb hisoblasangiz
        }

        return view('dashboard', compact(['products', 'latestProducts', 'basketCount']));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function store(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',  // Image validation
        ]);

        // Handle the image upload if it exists
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/products');
        } else {
            $imagePath = null;
        }

        // Create the new product
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,  // Store the image path
        ]);

        return redirect()->back()->with('success', 'Product created successfully!');
    }
}
