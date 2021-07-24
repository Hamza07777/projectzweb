<?php

namespace App\Http\Controllers;

use App\Models\VaccineDetail;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class VaccineDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $vaccineDetails = VaccineDetail::get()->sortByDesc('created_at');
        return view('vaccine_detail.index', compact('vaccineDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('vaccine_detail.addEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param VaccineDetail $vaccineDetail
     * @return RedirectResponse
     */
    public function store(Request $request,VaccineDetail $vaccineDetail)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'detail' => 'required',
            'image' => 'required|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $formData = $request->all();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $imageName = uniqid() .'.'. $file->getClientOriginalExtension();
            $path = public_path(vaccineDetailPath());
            $file->move($path,$imageName);
            $formData['image'] = vaccineDetailPath().$imageName;
        }

        $vaccineDetail->create($formData);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Vaccine detail added successfully');

        return redirect()->route('vaccine-detail.index');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
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
        $vaccineDetail = VaccineDetail::findOrFail($id);
        return view('vaccine_detail.addEdit', compact('vaccineDetail'));
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
        $vaccineDetail = VaccineDetail::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'detail' => 'required',
            'image' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $formData = $request->all();
        if($request->hasFile('image')){
            if(file_exists(public_path($vaccineDetail->image))) {
                unlink(public_path($vaccineDetail->image));
            }
            $file = $request->file('image');
            $imageName = uniqid() .'.'. $file->getClientOriginalExtension();
            $path = public_path(vaccineDetailPath());
            $file->move($path,$imageName);
            $formData['image'] = vaccineDetailPath().$imageName;
        }

        $vaccineDetail->update($formData);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Vaccine detail updated successfully');

        return redirect()->route('vaccine-detail.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $vaccineDetail = VaccineDetail::findOrFail($id);
        if(file_exists(public_path($vaccineDetail->image))) {
            unlink(public_path($vaccineDetail->image));
        }
        $vaccineDetail->delete();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Vaccine detail deleted successfully');

        return redirect()->route('vaccine-detail.index');
    }
}
