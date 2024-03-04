<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::all();
        return view('settings.index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'location' => 'required|string|max:500',
            'email' => 'required|email|unique:settings',
            'phone' => 'required|string',
            'lat' => 'required|numeric|between:-90,90',
            'long' => 'required|numeric|between:-180,180',

        ]);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $logo = $request->file('logo');
        $ext = $logo->getClientOriginalExtension();
        $location = "/public";
        $fileName = Date("Y-m-d-h-i-s") . '.' .$ext;
        $logo->storeAs( $location,$fileName);

        $setting = new Setting();
        $setting->logo = $fileName;
        $setting->location = $request->location;
        $setting->email = $request->email;
        $setting->phone = $request->phone;
        $setting->lat = $request->lat;
        $setting->long = $request->long;
        $setting->save();

        Session::flash('message','Setting is Created Successfully');
        return redirect(route('settings.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        return view('settings.edit',compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
        'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        'location' => 'required|string|max:500',
        'email' => 'required|email',
        'phone' => 'required|string',
        'lat' => 'required|numeric|between:-90,90',
        'long' => 'required|numeric|between:-180,180',
    ]);

    if($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

     $setting = Setting::findOrFail($id);
     if($request->hasFile('logo')) {
        $logo = $request->file('logo');
        $ext = $logo->getClientOriginalExtension();
        $location = "/public";
        $fileName = date("Y-m-d-h-i-s") . '.' . $ext;
        $logo->storeAs($location, $fileName);
        $data['logo'] = $fileName;
    }

    $data = [
        'location' => $request->location,
        'email' => $request->email,
        'phone' => $request->phone,
        'lat' => $request->lat,
        'long' => $request->long,
    ];
    $setting->update($data);

    Session::flash('message','Setting is Updated Successfully');
    return redirect(route('settings.index'));
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $setting = Setting::findOrFail($id);
        if($setting != null){
           $setting->delete();
        }
        Session::flash('message','Setting is Deleted Now!');
        return redirect(route('settings.index'));
    }
}
