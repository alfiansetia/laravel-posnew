<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Cart::with('product')->where('user_id', auth()->id())->get();
            foreach ($data as $key => $item) {
                if ($item->product->status != 'active' || $item->qty > ($item->product->stock - $item->product->min_stock)) {
                    $item->delete();
                    $data->forget($key);
                }
            }
            return response()->json(['data' => $data]);
        } else {
            abort(404);
        }
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'product'   => [
                'required',
                'integer',
                'exists:products,id',
                'unique:carts,product_id,NULL,id,user_id,' . auth()->id(),
                function ($attribute, $productId, $fail) {
                    $product = Product::where('status', 'active')->find($productId);
                    if (!$product) {
                        $fail("The selected product is not active.");
                    }
                },
            ],
            'qty'       => [
                'required',
                'gte:1',
                function ($attribute, $qty, $fail) use ($request) {
                    $productId = $request->product;
                    $product = Product::find($productId);
                    $stock = $product->stock ?? 0;
                    $minStock =  $product->min_stock ?? 0;
                    if ($qty > ($stock - $minStock)) {
                        $fail("The selected quantity exceeds the available stock.");
                    }
                },
            ]
        ]);
        $cart = Cart::create([
            'user_id'       => auth()->id(),
            'product_id'    => $request->product,
            'qty'           => $request->qty
        ]);
        if ($cart) {
            return response()->json(['message' => 'Ok']);
        } else {
            return response()->json(['message' => 'Fail'], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);
        if (!$cart) {
            return response()->json(['message' => 'Not Found!'], 404);
        }
        $this->validate($request, [
            'qty'       => [
                'required',
                'gte:1',
                function ($attribute, $qty, $fail) use ($cart) {
                    $stock = $cart->product->stock ?? 0;
                    $minStock =  $cart->product->min_stock ?? 0;
                    if ($qty > ($stock - $minStock)) {
                        $fail("The selected quantity exceeds the available stock.");
                    }
                },
            ]
        ]);
        $cart = $cart->update([
            'qty'           => $request->qty
        ]);
        if ($cart) {
            return response()->json(['message' => 'Ok']);
        } else {
            return response()->json(['message' => 'Fail'], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cart = Cart::find($id);
        if (!$cart) {
            return response()->json(['message' => 'Not Found!'], 404);
        }
        $cart = $cart->delete();
        if ($cart) {
            return response()->json(['message' => 'OK']);
        } else {
            return response()->json(['message' => 'Fail'], 422);
        }
    }

    public function truncate()
    {
        $cart = Cart::where('user_id', auth()->id())->delete();
        if ($cart) {
            return redirect()->back()->with(['success' => 'Empty Cart Success!']);
        } else {
            return redirect()->back()->with(['error' => 'Empty Cart Failed!']);
        }
    }
}
