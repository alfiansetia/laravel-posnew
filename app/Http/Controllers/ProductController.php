<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $comp;
    private $title = 'Product';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->comp = Company::first();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::all();
        return view('product.index', compact('data'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        $supplier = Supplier::all();
        return view('product.create', compact(['category', 'supplier']))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'sku'       => 'nullable|max:50',
            'name'      => 'required|max:50|min:3',
            'desc'      => 'nullable|max:150',
            'unit'      => 'required|max:10',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'discount'  => 'required|integer|gte:0',
            'stock'     => 'required|integer|gte:0',
            'min_stock' => 'required|integer|gte:0',
            'selling_price'     => 'required|integer|gte:0',
            'purchase_price'    => 'required|integer|gte:0',
            'status'    => 'nullable|in:active',
            'supplier'  => 'required|integer|exists:suppliers,id',
            'category'  => 'required|integer|exists:categories,id',
            'length'    => 'required|integer|gte:0',
            'width'     => 'required|integer|gte:0',
            'height'    => 'required|integer|gte:0',
            'weight'    => 'required|integer|gte:0',
        ]);
        $image = null;
        if ($files = $request->file('image')) {
            $destinationPath = 'images/product/';
            $logo = 'product_' . date('dmYHis') . '.' . $files->getClientOriginalExtension();
            $files->move($destinationPath, $logo);
        }

        $product = Product::create([
            'code'      => $request->code,
            'sku'       => $request->sku,
            'name'      => $request->name,
            'desc'      => $request->desc,
            'unit'      => $request->unit,
            'image'     => $image,
            'disc'      => $request->discount,
            'stock'     => $request->stock,
            'min_stock' => $request->min_stock,
            'sell_price'  => $request->selling_price,
            'purc_price'  => $request->purchase_price,
            'supplier_id' => $request->supplier,
            'category_id' => $request->category,
            'status'    => $request->status ?? 'nonactive',
            'length'    => $request->length,
            'width'     => $request->width,
            'height'    => $request->height,
            'weight'    => $request->weight,
        ]);
        if ($product) {
            return redirect()->route('product.index')->with(['success' => 'Add Data Success!']);
        } else {
            return redirect()->route('product.index')->with(['error' => 'Add Data Failed!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $data = $product->load('category');
        return view('product.detail', compact('data'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $data = $product;
        $category = Category::all();
        return view('product.edit', compact(['data', 'category']))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product = $product->delete();
        if ($product) {
            return redirect()->route('product.index')->with(['success' => 'Remove Data Success!']);
        } else {
            return redirect()->route('product.index')->with(['error' => 'Remove Data Failed!']);
        }
    }
}
