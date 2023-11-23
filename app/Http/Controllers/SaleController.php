<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Company;
use App\Models\Sale;
use App\Models\SaleDetail;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Sale::query();
            return DataTables::of($data)->setRowId('id')->toJson();
        }
        return view('sale.index')->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $last = Sale::latest('id')->first();
        return view('sale.create', compact('last'))->with(['title' => $this->title, 'company' => $this->comp]);
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
            'type'      => 'required|in:cash,cashless',
            'trx_id'    => 'required_if:type,cashless',
        ]);

        $cart = Cart::where('user_id', auth()->id())->get();
        if (count($cart ?? []) > 0) {
            DB::beginTransaction();
            try {
                $currentDate = Carbon::now();
                $count = Sale::whereYear('date', $currentDate->year)
                    ->whereMonth('date', $currentDate->month)
                    ->orderByDesc('number')
                    ->first();
                $counti = 1;
                if ($count) {
                    $counti = ($count->getRawOriginal('number') ?? 0) + 1;
                }
                $total = 0;
                foreach ($cart as $item) {
                    $price = $item->qty * $item->product->sell_price;
                    $disc = $price * $item->product->disc / 100;
                    $subtotal = $price - $disc;
                    $total = $total + $subtotal;
                }
                $tax = $total * $request->tax / 100;
                $totalIncludingTax = $total + $tax;

                $sale = Sale::create([
                    'date'          => date('Y-m-d H:i:s'),
                    'number'        => $counti,
                    'customer_id'   => $request->customer,
                    'user_id'       => auth()->id(),
                    'desc'          => $request->desc,
                    'tax'           => $request->tax,
                    'bill'          => $request->bill,
                    'total'         => $totalIncludingTax,
                    'status'        => 'done',
                    'trx_id'        => $request->trx_id,
                ]);
                foreach ($cart as $item) {
                    SaleDetail::create([
                        'sale_id'       => $sale->id,
                        'product_id'    => $item->product_id,
                        'price'         => $item->product->sell_price,
                        'disc'          => $item->product->disc,
                        'unit'          => $item->product->unit,
                        'qty'           => $item->qty,
                    ]);
                    $final_stock = $item->product->stock - $item->qty;
                    $item->product->update(['stock' => $final_stock]);
                    $item->delete();
                }
                DB::commit();
                return redirect()->route('sale.create')->with(['success' => 'Add Data Success']);
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->route('sale.create')->with(['error' => 'Add Data Failed! ' . $e->getMessage()]);
            }
        } else {
            return redirect()->back()->with(['error' => 'Cart Empty!']);
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
        $data = $sale->load('sale_detail');
        return view('sale.edit', compact('data'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        $this->validate($request, [
            'desc'      => 'nullable|max:100',
            'type'      => 'required|in:cash,cashless',
            'trx_id'    => 'required_if:type,cashless',
        ]);
        $sale = $sale->update([
            'desc'      => $request->desc,
            'type'      => $request->type,
            'trx_id'    => $request->trx_id,
        ]);
        if ($sale) {
            return redirect()->route('sale.index')->with(['success' => 'Update Data Success']);
        } else {
            return redirect()->route('sale.index')->with(['error' => 'Update Data Failed!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        if ($sale->status === 'cancel') {
            return redirect()->route('sale.index')->with(['error' => 'Cancel Data Failed! Data already canceled!']);
        }
        DB::beginTransaction();
        try {
            $products = $sale->sale_detail ?? [];
            if (count($products) > 0) {
                foreach ($products as $item) {
                    $product = $item->product;
                    if ($product) {
                        $product->update([
                            'stock' => $product->stock + $item->qty,
                        ]);
                    }
                }
            }
            $sale = $sale->update([
                'status' => 'cancel',
            ]);
            DB::commit();
            return redirect()->route('sale.index')->with(['success' => 'Cancel Data Success']);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('sale.index')->with(['error' => 'Cancel Data Failed! ' . $e->getMessage()]);
        }
    }
}
