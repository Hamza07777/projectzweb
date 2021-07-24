<?php

namespace App\Http\Controllers;

use App\Models\SubAdmin;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SubAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $users = User::where('role', 'sub-admin')->get()->sortByDesc('created_at');
        return view('sub_admin.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('sub_admin.addEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @param SubAdmin $subAdmin
     * @return RedirectResponse
     */
    public function store(Request $request, User $user, SubAdmin $subAdmin)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'dob' => 'required|date_format:m/d/Y',
            'profession' => 'required',
            'lga' => 'required',
            'address' => 'required',
            'state' => 'required'
        ]);

        $password = Hash::make($request->input('password'));
        $request->merge(['password' => $password]);

        $userData = $request->only('name', 'email', 'password');
        $userData['role'] = 'sub-admin';
        $user = $user->create($userData);

        $subAdminData = $request->only('dob', 'profession', 'lga', 'address', 'state');
        $subAdminData['user_id'] = $user->id;
        $subAdmin->create($subAdminData);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Sub admin added successfully');

        return redirect()->route('sub-admin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('sub_admin.addEdit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'dob' => 'required|date_format:m/d/Y',
            'profession' => 'required',
            'lga' => 'required',
            'address' => 'required',
            'state' => 'required'
        ]);

        $userData = $request->only('name', 'email');
        if ($request->has('password')) {
            $password = Hash::make($request->input('password'));
            $request->merge(['password' => $password]);
            $userData['password'] = $password;
        }

        $user->update($userData);

        $subAdminData = $request->only('dob', 'profession', 'lga', 'address', 'state');
        $user->subAdmin->update($subAdminData);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Sub admin updated successfully');

        return redirect()->route('sub-admin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Sub admin deleted successfully');

        return redirect()->route('sub-admin.index');
    }

    public function userUpdate(Request $request)
    {
        $user = auth()->user();

        if (\request()->method() == 'GET') {
            $account = true;
            if (isAdmin()) {
                $admin = true;
            }
            return view('sub_admin.addEdit', compact('user', 'account', 'admin'));
        }

        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'dob' => 'required|date_format:m/d/Y',
            'profession' => 'required',
            'lga' => 'required',
            'address' => 'required',
            'state' => 'required'
        ];

        if (isAdmin()) {
            $rules = [
                'name' => 'required',
                'email' => 'required|unique:users,email,' . $user->id,
                'password' => 'nullable|min:6'
            ];
        }
        $request->validate($rules);

        $userData = $request->only('name', 'email');
        if ($request->has('password')) {
            $password = Hash::make($request->input('password'));
            $request->merge(['password' => $password]);
            $userData['password'] = $password;
        }

        $user->update($userData);

        if (!isAdmin()) {
            $subAdminData = $request->only('dob', 'profession', 'lga', 'address', 'state');
            $user->subAdmin->update($subAdminData);
        }
        session()->flash('alert-type', 'success');
        session()->flash('message', 'Profile updated successfully');

        return redirect()->route('userUpdate');

    }

    public function changePassword(Request $request)
    {
        if (\request()->method() == 'GET') {
            return view('sub_admin.change_password');
        }

        $user = auth()->user();

        /*
        * Validate all input fields
        */
        $this->validate($request, [
            'password' => 'required|min:6',
            'current_password' => 'required',
            'new_password' => ['same:password'],
        ]);

        if (Hash::check($request->current_password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();

            session()->flash('alert-type', 'success');
            session()->flash('message', 'Password changed successfully');

            return redirect()->route('changePassword');

        } else {
            $request->session()->flash('error', 'Old password does not match');
            return redirect()->route('changePassword');
        }
    }
}
