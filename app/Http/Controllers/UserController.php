<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\VaccineCenter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $users = User::where('role', 'user')->get()->sortByDesc('created_at');
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $vaccineCenters = VaccineCenter::get()->sortBy('name');
        return view('user.addEdit', compact('vaccineCenters'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @param UserProfile $userProfile
     * @return RedirectResponse
     */
    public function store(Request $request, User $user, UserProfile $userProfile)
    {
        $attributeNames = [
            'first_name' => 'first_name',
            'middle_name' => 'middle name',
            'last_name' => 'last name',
            'dob' => 'date of birth',
            'vaccine_center' => 'vaccine center',
            'test_result' => 'test result',
            'state_of_origin' => 'state of origin',
            'phone_number' => 'phone number',
        ];

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|min:6',
            'dob' => 'required|date_format:m/d/Y',
            'vaccine_center' => 'required|exists:vaccine_centers,id',
            'state_of_origin' => 'required',
            'test_result' => 'required',
            'phone_number' => 'required|unique:user_profiles',
            'city' => 'required',
            'address' => 'required',
            'email' => 'required|unique:users,email',
            'image' => 'required|image',
        ]);

        $validator->setAttributeNames($attributeNames);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $password = Hash::make($request->input('password'));
        $request->merge(['password' => $password]);

        $userData = $request->only('email', 'password');

        $userData['name'] = $request->input('first_name') . ' ' . $request->input('last_name');
        $userData['role'] = 'user';
        $user = $user->create($userData);

        $formData = $request->only('first_name', 'middle_name', 'last_name',
            'dob', 'vaccine_center', 'state_of_origin', 'test_result', 'city', 'address', 'image', 'phone_number');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = public_path(userImagePath());
            $file->move($path, $imageName);
            $formData['image'] = userImagePath() . $imageName;
        }

        $formData['user_id'] = $user->id;
        $userProfile = $userProfile->create($formData);

        $mergedArray = array_merge($userData, $formData);

        $qrCode = uniqid() . '_qrCode.png';
        QrCode::size(150)
            ->format('png')
            ->generate(json_encode($mergedArray), public_path(userBarCodePath() . $qrCode));

        $userProfile->barcode = userBarCodePath() . $qrCode;
        $userProfile->save();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'User added successfully');

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
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
        $vaccineCenters = VaccineCenter::get()->sortBy('name');
        return view('user.addEdit', compact('user', 'vaccineCenters'));
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
        $attributeNames = [
            'first_name' => 'first name',
            'middle_name' => 'middle name',
            'last_name' => 'last name',
            'dob' => 'date of birth',
            'vaccine_center' => 'vaccine center',
            'test_result' => 'test result',
            'state_of_origin' => 'state of origin',
            'phone_number' => 'phone number',
        ];

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'nullable|min:6',
            'dob' => 'required|date_format:m/d/Y',
            'vaccine_center' => 'required|exists:vaccine_centers,id',
            'state_of_origin' => 'required',
            'test_result' => 'required',
            'phone_number' => 'required|unique:user_profiles,user_id,' . $id,
            'city' => 'required',
            'address' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'image' => 'nullable|image',
        ]);

        $validator->setAttributeNames($attributeNames);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $userData = $request->only('email');
        if ($request->has('password')) {
            $password = Hash::make($request->input('password'));
            $request->merge(['password' => $password]);
            $userData['password'] = $password;
        }

        $userData['name'] = $request->input('first_name') . ' ' . $request->input('last_name');
        $user->update($userData);

        $formData = $request->only('first_name', 'middle_name', 'last_name',
            'dob', 'vaccine_center', 'state_of_origin', 'test_result', 'city', 'address', 'image', 'phone_number');

        if ($request->hasFile('image')) {
            if (isset($user->profile->image) && file_exists(public_path($user->profile->image))) {
                unlink(public_path($user->profile->image));
            }
            $file = $request->file('image');
            $imageName = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = public_path(userImagePath());
            $file->move($path, $imageName);
            $formData['image'] = userImagePath() . $imageName;
        }

        $userProfileObject = $user->profile;
        $user->profile->update($formData);

        unset($userData['password']);
        $vaccineCenterName  = $user->profile->vaccineCenter->name ?? '';
        $formData['vaccine_center'] = $vaccineCenterName;
        $mergedArray = array_merge($userData, $formData);

        if (isset($user->profile->barcode) && file_exists(public_path($user->profile->barcode))) {
            unlink(public_path($user->profile->barcode));
        }
        $qrCode = uniqid() . '_qrCode.png';
        QrCode::size(150)
            ->format('png')
            ->generate(json_encode($mergedArray), public_path(userBarCodePath() . $qrCode));

        $userProfileObject->barcode = userBarCodePath() . $qrCode;
        $userProfileObject->save();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'User updated successfully');

        return redirect()->route('users.index');
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
        if (isset($user->profile->image) && file_exists(public_path($user->profile->image))) {
            unlink(public_path($user->profile->image));
        }
        if (isset($user->profile->barcode) && file_exists(public_path($user->profile->barcode))) {
            unlink(public_path($user->profile->barcode));
        }
        $user->delete();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'User deleted successfully');

        return redirect()->route('users.index');
    }
}
