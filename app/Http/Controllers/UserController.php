<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $comp;
    private $title = 'User';

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
        $data = User::all();
        return view('user.index', compact('data'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create')->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|max:50|min:3',
            'email'     => 'required|email|max:50|min:3|unique:users,email',
            'phone'     => 'required|numeric|digits_between:8,15',
            'password'  => 'required|min:5',
            'role'      => 'required|in:admin,user',
            'status'    => 'nullable|in:active',
        ]);
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'status'    => $request->status ?? 'nonactive',
        ]);
        if ($user) {
            return redirect()->route('user.index')->with(['success' => 'Add Data Success!']);
        } else {
            return redirect()->route('user.index')->with(['error' => 'Add Data Failed!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $data = $user;
        return view('user.detail', compact('data'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $data = $user;
        return view('user.edit', compact('data'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name'      => 'required|max:50|min:3',
            'email'     => 'required|email|max:50|min:3|unique:users,email,' . $user->id,
            'phone'     => 'required|max:15|min:8',
            'password'  => 'nullable|min:5',
            'role'      => 'required|in:admin,user',
            'status'    => 'nullable|in:active',
        ]);
        if ($request->filled('password')) {
            $user->update([
                'password'  => Hash::make($request->password),
            ]);
        }
        $user = $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'role'      => $request->role,
            'status'    => $request->status ?? 'nonactive',
        ]);
        if ($user) {
            return redirect()->route('user.index')->with(['success' => 'Update Data Success!']);
        } else {
            return redirect()->route('user.index')->with(['error' => 'Update Data Failed!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user = $user->delete();
        if ($user) {
            return redirect()->route('user.index')->with(['success' => 'Remove Data Success!']);
        } else {
            return redirect()->route('user.index')->with(['error' => 'Remove Data Failed!']);
        }
    }
}
