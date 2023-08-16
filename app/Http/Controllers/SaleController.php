<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    private $comp;
    private $title = 'Sale';

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
        $data = Sale::all();
        return view('sale.index', compact('data'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $date = Carbon::parse(date('Y-m-d H:i:s'));
        $sale =  Sale::whereYear('date', $date->year)
            ->whereMonth('date', $date->month)
            ->orderByDesc('number')
            ->first();
        dd($sale);
        $customer = Customer::all();
        return view('sale.create', compact('customer'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'customer'  => 'required|integer|exists:customers,id',
            'desc'      => 'nullable|max:100',
            'tax'       => 'required|integer|gte:0|lte:100',
            'bill'      => 'required|integer|gte:0',
        ]);

        $count = Sale::whereYear('date', now()->year())
            ->whereMonth('date', now()->month())
            ->orderByDesc('number')
            ->first();
        $counti = 1;
        if ($count) {
            $counti = ($count->getRawOriginal('number') ?? 0) + 1;
        }

        $cart = Cart::where('user_id', auth()->id())->get();
        if (count($cart ?? []) > 0) {
            $last = Sale::latest('id')->first() ?? (0 + 1);
            $sale = Sale::create([
                'number'        => $counti,
                'customer_id'   => $request->customer,
                'desc'          => $request->desc,
                'tax'           => $request->tax,
                'bill'          => $request->bill,
            ]);
            foreach ($cart as $item) {
                SaleDetail::create([
                    'sale_id'       => $sale->id,
                    'product_id'    => $item->product_id,
                    'price'         => $item->product->sell_price,
                    'disc'          => $item->product->disc,
                    'qty'           => $item->qty,
                ]);
                $item->delete();
            }

            if ($cart) {
                return redirect()->route('sale.index')->with(['success' => 'Add Data Success']);
            } else {
                return redirect()->route('sale.index')->with(['error' => 'Add Data Failed!']);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        $data = $sale->load('sale_detail');
        return view('sale.detail', compact('data'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        $sale = $sale->update([
            'status' => 'cancel',
        ]);
        if ($sale) {
            return redirect()->route('sale.index')->with(['success' => 'Cancel Data Success']);
        } else {
            return redirect()->route('sale.index')->with(['error' => 'Cancel Data Failed!']);
        }
    }
}
