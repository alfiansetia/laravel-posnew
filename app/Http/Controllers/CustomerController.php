<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    private $comp;
    private $title = 'Customer';

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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::query();
            return DataTables::of($data)->setRowId('id')->toJson();
        }
        return view('customer.index')->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create')->with(['title' => $this->title, 'company' => $this->comp]);
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
        $customer = Customer::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
        ]);
        if ($customer) {
            return redirect()->route('customer.index')->with(['success' => 'Add Data Success!']);
        } else {
            return redirect()->route('customer.index')->with(['error' => 'Add Data Failed!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $data = $customer;
        return view('customer.detail', compact('data'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $data = $customer;
        return view('customer.edit', compact('data'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'name'      => 'required|min:3|max:50',
            'email'     => 'required|min:3|max:50|email',
            'phone'     => 'required|digits_between:8,15',
            'address'   => 'nullable|min:3|max:100',
        ]);
        $customer = $customer->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
        ]);
        if ($customer) {
            return redirect()->route('customer.index')->with(['success' => 'Add Data Success!']);
        } else {
            return redirect()->route('customer.index')->with(['error' => 'Add Data Failed!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer = $customer->delete();
        if ($customer) {
            return redirect()->route('customer.index')->with(['success' => 'Remove Data Success!']);
        } else {
            return redirect()->route('customer.index')->with(['error' => 'Remove Data Failed!']);
        }
    }
}
