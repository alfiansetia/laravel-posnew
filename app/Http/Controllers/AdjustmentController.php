<?php

namespace App\Http\Controllers;

use App\Models\Adjustment;
use App\Models\Company;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AdjustmentController extends Controller
{
    private $comp;
    private $title = 'Adjustment';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin')->only('destroy');
        $this->comp = Company::first();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Adjustment::query()->with('product');
            return DataTables::of($data)->setRowId('id')->toJson();
        }
        return view('adjustment.index')->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adjustment.create')->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product'   => 'required|integer|exists:products,id',
            'type'      => 'required|in:plus,minus',
            'value'     => [
                'required',
                'gt:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->type === 'minus') {
                        $product = Product::find($request->product);
                        if ((($product->stock ?? 0) - $value) < 1) {
                            $fail("Current stock is $product->stock! Stock product cannot minus !");
                        }
                    }
                },
            ],
            'desc'      => 'nullable|max:100',
        ]);

        DB::beginTransaction();
        try {
            $currentDate = Carbon::now();
            $count = Adjustment::whereYear('date', $currentDate->year)
                ->whereMonth('date', $currentDate->month)
                ->orderByDesc('number')
                ->first();
            $counti = 1;
            if ($count) {
                $counti = ($count->getRawOriginal('number') ?? 0) + 1;
            }
            $product = Product::findOrFail($request->product);
            $current_value = $product->stock;
            $new_value = $current_value + $request->value;
            if ($request->type === 'minus') {
                $new_value = $current_value - $request->value;
            }
            $adjustment = Adjustment::create([
                'date'          => date('Y-m-d H:i:s'),
                'number'        => $counti,
                'user_id'       => auth()->id(),
                'product_id'    => $request->product,
                'type'          => $request->type,
                'value'         => $request->value,
                'current_value' => $current_value,
                'after_value'   => $new_value,
                'type'          => $request->type,
            ]);
            $product->update([
                'stock' => $new_value,
            ]);
            DB::commit();
            return redirect()->route('adjustment.index')->with(['success' => 'Add Data Success!']);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('adjustment.index')->with(['error' => 'Add Data Failed! ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Adjustment $adjustment)
    {
        $data = $adjustment->load('product', 'user');
        return view('adjustment.detail', compact('data'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Adjustment $adjustment)
    {
        $data = $adjustment->load('product', 'user');
        return view('adjustment.edit', compact('data'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Adjustment $adjustment)
    {
        $this->validate($request, [
            'desc' => 'nullable|max:100',
        ]);
        $adjustment->update([
            'desc' => $request->desc,
        ]);
        if ($adjustment) {
            return redirect()->route('adjustment.index')->with(['success' => 'Update Data Success!']);
        } else {
            return redirect()->route('adjustment.index')->with(['error' => 'Update Data Failed!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Adjustment $adjustment)
    {
        if ($adjustment->status === 'cancel') {
            return redirect()->route('adjustment.index')->with(['error' => 'Cancel Data Failed! Data already canceled!']);
        }
        DB::beginTransaction();
        try {
            if ($adjustment->product) {
                $current_value = $adjustment->product->stock;
                $new_value = $current_value + $adjustment->value;
                if ($adjustment->type === 'plus') {
                    if ($current_value < $adjustment->value) {
                        throw new Exception("Stock cannot minus!");
                    }
                    $new_value = $current_value - $adjustment->value;
                }
                $adjustment->product->update([
                    'stock' => $new_value,
                ]);
            }
            $adjustment = $adjustment->update([
                'status' => 'cancel',
            ]);
            DB::commit();
            return redirect()->route('adjustment.index')->with(['success' => 'Remove Data Success!']);
        } catch (Exception $e) {
            return redirect()->route('adjustment.index')->with(['error' => 'Remove Data Failed! ' . $e->getMessage()]);
        }
    }
}
