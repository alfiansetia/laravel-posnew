<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    private $comp;
    private $title = 'Supplier';

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
        $data = Supplier::all();
        return view('supplier.index', compact('data'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.create')->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|min:3|max:50',
            'email'     => 'required|min:3|max:50|email',
            'phone'     => 'required|digits_between:8,15',
            'address'   => 'nullable|min:3|max:100',
        ]);
        $supplier = Supplier::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
        ]);
        if ($supplier) {
            return redirect()->route('supplier.index')->with(['success' => 'Add Data Success!']);
        } else {
            return redirect()->route('supplier.index')->with(['error' => 'Add Data Failed!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        $data = $supplier->loadCount('product');
        return view('supplier.detail', compact('data'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        $data = $supplier;
        return view('supplier.edit', compact('data'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $this->validate($request, [
            'name'      => 'required|min:3|max:50',
            'email'     => 'required|min:3|max:50|email',
            'phone'     => 'required|digits_between:8,15',
            'address'   => 'nullable|min:3|max:100',
        ]);
        $supplier = $supplier->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
        ]);
        if ($supplier) {
            return redirect()->route('supplier.index')->with(['success' => 'Add Data Success!']);
        } else {
            return redirect()->route('supplier.index')->with(['error' => 'Add Data Failed!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier = $supplier->delete();
        if ($supplier) {
            return redirect()->route('supplier.index')->with(['success' => 'Remove Data Success!']);
        } else {
            return redirect()->route('supplier.index')->with(['error' => 'Remove Data Failed!']);
        }
    }
}
