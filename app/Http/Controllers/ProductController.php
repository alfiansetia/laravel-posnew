<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    private $comp;
    private $title = 'Product';

    private $image_path;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->comp = Company::first();
        $this->image_path = public_path('images/product/');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Product::all();
        if ($request->ajax()) {
            $data = Product::with('category')->where('status', 'active')->get();
            return response()->json(['data' => $data]);
        }
        return view('product.index', compact('data'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::all();
        $supplier = Supplier::all();
        $last = 'P-' . str_pad((Product::latest('id')->first()->id ?? 0) + 1, 4, '0', STR_PAD_LEFT);
        return view('product.create', compact(['category', 'supplier', 'last']))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'sku'       => 'nullable|max:50',
            'code'      => 'required|max:50|unique:products,code',
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
            $image = 'product_' . date('dmyHis') . '.' . $files->getClientOriginalExtension();
            $files->move($this->image_path, $image);
        }

        $product = Product::create([
            'code'      => $request->code,
            'sku'       => $request->sku,
            'name'      => $request->name,
            'desc'      => $request->desc,
            'unit'      => strtoupper($request->unit),
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
    public function show(Request $request, Product $product)
    {
        $data = $product->load('category');
        if ($request->ajax()) {
            return response()->json(['data' => $data]);
        }
        return view('product.detail', compact('data'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $data = $product;
        $category = Category::all();
        $supplier = Supplier::all();
        return view('product.edit', compact(['data', 'category', 'supplier']))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'sku'       => 'nullable|max:50',
            'code'      => 'required|max:50|unique:products,code,' . $product->id,
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
        $image = $product->getRawOriginal('image');

        if ($files = $request->file('image')) {
            if (!empty($image) && file_exists($this->image_path . $image)) {
                File::delete($this->image_path . $image);
            }

            $image = 'product_' . date('dmyHis') . '.' . $files->getClientOriginalExtension();
            $files->move($this->image_path, $image);
        }

        $product = $product->update([
            'code'      => $request->code,
            'sku'       => $request->sku,
            'name'      => $request->name,
            'desc'      => $request->desc,
            'unit'      => strtoupper($request->unit),
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
            return redirect()->route('product.index')->with(['success' => 'Update Data Success!']);
        } else {
            return redirect()->route('product.index')->with(['error' => 'Update Data Failed!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $image = $product->getRawOriginal('image');
        if (!empty($image) && file_exists($this->image_path . $image)) {
            File::delete($this->image_path . $image);
        }
        $product = $product->delete();
        if ($product) {
            return redirect()->route('product.index')->with(['success' => 'Remove Data Success!']);
        } else {
            return redirect()->route('product.index')->with(['error' => 'Remove Data Failed!']);
        }
    }
}
