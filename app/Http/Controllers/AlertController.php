<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $alerts = Alert::get()->sortByDesc('created_at');
        return view('alert.index', compact('alerts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('alert.addEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Alert $alert
     * @return RedirectResponse
     */
    public function store(Request $request,Alert $alert)
    {

        $messages = [
            'video.max' => 'The video must not be greater than 5MB.'
        ];


        $rules = [
            'image' => 'nullable|image',
            'video' => 'nullable|max:5120|mimes:ogm,wmv,mpg,webm,ogv,mov,asx,mpeg,mp4,m4v,avi,mov,3gp,flv,mkv',
            'description' => 'required',
        ];

        $this->validate($request, $rules, $messages);

        $formData = $request->all();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $imageName = uniqid() .'.'. $file->getClientOriginalExtension();
            $path = public_path(alertImagePath());
            $file->move($path,$imageName);
            $formData['image'] = alertImagePath().$imageName;
        }

        if($request->hasFile('video')){
            $file = $request->file('video');
            $videoName = uniqid() .'.'. $file->getClientOriginalExtension();
            $path = public_path(alertVideoPath());
            $file->move($path,$videoName);
            $formData['video'] = alertVideoPath().$videoName;
        }

        $alert->create($formData);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Alert added successfully');

        return redirect()->route('alert.index');

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
        $alert = Alert::findOrFail($id);
        return view('alert.addEdit', compact('alert'));
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
        $alert = Alert::findOrFail($id);

        $messages = [
            'video.max' => 'The video must not be greater than 5MB.'
        ];


        $rules = [
            'image' => 'nullable|image',
            'video' => 'nullable|max:5120|mimes:ogm,wmv,mpg,webm,ogv,mov,asx,mpeg,mp4,m4v,avi,mov,3gp,flv,mkv',
            'description' => 'required',
        ];

        $this->validate($request, $rules, $messages);

        $formData = $request->all();

        if($request->has('is_deleted_video')){
            if($alert->video && file_exists(public_path($alert->video))) {
                unlink(public_path($alert->video));
            }
            $formData['video'] = null;
        }

        if($request->has('is_deleted_image')){
            if($alert->image && file_exists(public_path($alert->image))) {
                unlink(public_path($alert->image));
            }
            $formData['image'] = null;
        }

        if($request->hasFile('image')){
            if($alert->image && file_exists(public_path($alert->image))) {
                unlink(public_path($alert->image));
            }
            $file = $request->file('image');
            $imageName = uniqid() .'.'. $file->getClientOriginalExtension();
            $path = public_path(alertImagePath());
            $file->move($path,$imageName);
            $formData['image'] = alertImagePath().$imageName;
        }

        if($request->hasFile('video')){
            if($alert->video && file_exists(public_path($alert->video))) {
                unlink(public_path($alert->video));
            }
            $file = $request->file('video');
            $videoName = uniqid() .'.'. $file->getClientOriginalExtension();
            $path = public_path(alertVideoPath());
            $file->move($path,$videoName);
            $formData['video'] = alertVideoPath().$videoName;
        }

        $alert->update($formData);

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Alert updated successfully');

        return redirect()->route('alert.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $alert = Alert::findOrFail($id);
        if($alert->image && file_exists(public_path($alert->image))) {
            unlink(public_path($alert->image));
        }
        if($alert->video && file_exists(public_path($alert->video))) {
            unlink(public_path($alert->video));
        }
        $alert->delete();

        session()->flash('alert-type', 'success');
        session()->flash('message', 'Alert deleted successfully');

        return redirect()->route('alert.index');
    }
}
