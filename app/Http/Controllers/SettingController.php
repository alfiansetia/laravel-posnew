<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    private $comp;
    private $title = 'Profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->comp = Company::first();
    }

    public function profile()
    {
        $data = auth()->user();
        return view('setting.profile', compact('data'))->with(['title' => $this->title, 'company' => $this->comp]);
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|min:3|max:25',
            'phone'     => 'required|numeric|digits_between:8,15',
            'avatar'    => 'required|in:avatar1.png,avatar2.png,avatar3.png,avatar4.png,avatar5.png',
        ]);
        $user = Auth::user();
        $user = $user->update([
            'name'      => $request->name,
            'phone'     => $request->phone,
            'avatar'    => $request->avatar,
        ]);
        if ($user) {
            return redirect()->route('setting.profile')->with(['success' => 'Update Profile Success!']);
        } else {
            return redirect()->route('setting.profile')->with(['error' => 'Update Profile Failed!']);
        }
    }
}
