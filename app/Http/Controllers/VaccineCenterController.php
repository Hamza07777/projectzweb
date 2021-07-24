
<?php

namespace App\Http\Controllers;

use App\Models\VaccineCenter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VaccineCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $vaccines = VaccineCenter::get()->sortByDesc('created_at');
        return view('vaccine_center.index', compact('vaccines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('vaccine_center.addEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param VaccineCenter $vaccineCenter
     * @return RedirectResponse
     */
    public function store(Request $request,VaccineCenter $vaccineCenter)
    {
        $attributeNames = [
            'person_in_charge' => 'person in charge',
            'sent_vaccines' => 'vaccine sent'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lga' => 'required',
            'state' => 'required',
            'person_in_charge' => 'required|numeric',
            'sent_vaccines' => 'required|numeric',
        ]);

        $validator->setAttributeNames($attributeNames);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $vaccineCenter->create($request->except('_token'));

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Vaccine center added successfully');

        return redirect()->route('vaccine-center.index');

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
        $vaccineCenter = VaccineCenter::findOrFail($id);
        return view('vaccine_center.addEdit', compact('vaccineCenter'));
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
        $vaccineCenter = VaccineCenter::findOrFail($id);

        $attributeNames = [
            'person_in_charge' => 'person in charge',
            'sent_vaccines' => 'vaccine sent'
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'lga' => 'required',
            'state' => 'required',
            'person_in_charge' => 'required|numeric',
            'sent_vaccines' => 'required|numeric',
        ]);

        $validator->setAttributeNames($attributeNames);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $vaccineCenter->update($request->except('_token'));

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Vaccine center updated successfully');

        return redirect()->route('vaccine-center.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $vaccineCenter = VaccineCenter::findOrFail($id);
        $vaccineCenter->delete();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Vaccine center deleted successfully');

        return redirect()->route('vaccine-center.index');
    }
}
