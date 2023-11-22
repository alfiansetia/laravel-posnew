<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    private $comp;
    private $title = 'Category';

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
            $data = Category::query();
            return DataTables::of($data)->setRowId('id')->toJson();
        }
        return view('category.index')->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create')->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50|min:3',
            'desc' => 'nullable|max:100',
        ]);
        $category = Category::create([
            'name' => $request->name,
            'desc' => $request->desc,
        ]);
        if ($category) {
            return redirect()->route('category.index')->with(['success' => 'Add Data Success']);
        } else {
            return redirect()->route('category.index')->with(['error' => 'Add Data Failed!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $data = $category->loadCount('product');
        return view('category.detail', compact('data'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $data = $category;
        return view('category.edit', compact('data'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|max:50|min:3',
            'desc' => 'nullable|max:100',
        ]);
        $category = $category->update([
            'name' => $request->name,
            'desc' => $request->desc,
        ]);
        if ($category) {
            return redirect()->route('category.index')->with(['success' => 'Update Data Success']);
        } else {
            return redirect()->route('category.index')->with(['error' => 'Update Data Failed!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category = $category->delete();
        if ($category) {
            return redirect()->route('category.index')->with(['success' => 'Remove Data Success!']);
        } else {
            return redirect()->route('category.index')->with(['error' => 'Remove Data Failed!']);
        }
    }

    public function paginate(Request $request)
    {
        $limit = 15;
        $data = Category::query();
        if ($request->filled('limit') && is_numeric($request->limit) && $request->limit > 0) {
            $limit = $request->limit;
        }
        if ($request->filled('name')) {
            $data->orWhere('name', 'like', "%$request->name%");
        }
        $result = $data->paginate($limit)->withQueryString();
        return response()->json($result);
    }
}
