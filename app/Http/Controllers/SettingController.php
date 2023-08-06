<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class SettingController extends Controller
{
    private $comp;
    private $title_profile = 'Profile';
    private $title_company = 'Company';
    private $title_password = 'Password';

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
        return view('setting.profile', compact('data'))->with(['title' => $this->title_profile, 'company' => $this->comp]);
    }

    public function profileUpdate(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|min:3|max:25',
            'phone'     => 'required|numeric|digits_between:8,15',
            'avatar'    => 'required|in:avatar1.png,avatar2.png,avatar3.png,avatar4.png,avatar5.png',
        ]);
        $user = auth()->user()->update([
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

    public function password()
    {
        $data = auth()->user();
        return view('setting.password', compact('data'))->with(['title' => $this->title_password, 'company' => $this->comp]);
    }

    public function passwordUpdate(Request $request)
    {
        $this->validate($request, [
            'password'          => ['required', Password::min(5)->numbers()],
            'confirm_password'  => ['required', 'same:password'],
        ]);
        $user = auth()->user()->update([
            'password' => Hash::make($request->password),
        ]);
        if ($user) {
            return redirect()->route('setting.password')->with(['success' => 'Update Password Success!']);
        } else {
            return redirect()->route('setting.password')->with(['error' => 'Update Password Failed!']);
        }
    }

    public function company()
    {
        return view('setting.company')->with(['title' => $this->title_company, 'company' => $this->comp]);
    }

    public function companyUpdate(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|min:3|max:25',
            'phone'     => 'required|max:15|min:8',
            'adress'    => 'nullable|max:100',
            'logo'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tax'       => 'required|integer|gte:0',
            'paper_size'        => 'required|integer|gt:0',
            'footer_thermal'    => 'nullable|max:100',
        ]);

        $logo = $this->comp->getRawOriginal('logo');
        $image_path = public_path('images/company/');

        if ($files = $request->file('logo')) {
            if (!empty($logo) && file_exists($image_path . $logo)) {
                File::delete($image_path . $logo);
            }

            $logo = 'logo_' . date('dmyHis') . '.' . $files->getClientOriginalExtension();
            $files->move($image_path, $logo);
        }

        $company = $this->comp->update([
            'name'      => $request->name,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'logo'      => $logo,
            'tax'       => $request->tax,
            'paper_size'        => $request->paper_size,
            'footer_thermal'    => $request->footer_thermal,
        ]);
        if ($company) {
            return redirect()->route('setting.company')->with(['success' => 'Update Company Success!']);
        } else {
            return redirect()->route('setting.company')->with(['error' => 'Update Company Failed!']);
        }
    }
}
