<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Http\Request;

use App\Models\Setting;


class SettingController extends BaseController
{
   
    public function index()
    {
        $settings=Setting::all();
        return $this->sendResponse($settings, 'Settings have been restored successfully!' );

        // return view('pages.setting',compact('settings'));
    }



  /**************************************************************************************/
    
    public function create()
    {
        //
    }
  /**************************************************************************************/


    public function store(Request $request)
    {
            $setting = new Setting();
            $setting->name = $request->name;
            $setting->description = $request->description;
            $setting->email = $request->email;
            $setting->phone = $request->phone;
            $setting->address = $request->address;
            $setting->facebook = $request->facebook;
            $setting->twitter = $request->twitter;
            $setting->instagram = $request->instagram;
            $setting->youtube = $request->youtube;
            $setting->tiktok = $request->tiktok;
    
                // insert img
                if ($request->hasFile('logo')) {

                    $image = $request->file('logo');
                    $file_name = $image->getClientOriginalName();
        
                    $setting->logo = $file_name;
        
                    // move pic
                    $imageName = $request->logo->getClientOriginalName();
                    $request->logo->move(public_path('Attachments/' . $file_name), $file_name);
                }
            $setting->save();
         

            // return response()->json($setting);
        return $this->sendResponse($setting, 'setting Added Successfully!' );


    
            
    }

  /**************************************************************************************/

    public function show($id)
    {
        //
    }
  /**************************************************************************************/

    public function edit($id)
    {
        //
    }
  /**************************************************************************************/


    public function update(Request $request,$id)
    {
        $setting=Setting::findOrFail($id);

        $setting->name = $request->name;
        $setting->description = $request->description;
        $setting->email = $request->email;
        $setting->phone = $request->phone;
        $setting->address = $request->address;
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        $setting->instagram = $request->instagram;
        $setting->youtube = $request->youtube;
        $setting->tiktok = $request->tiktok;

            // insert img
            if ($request->hasFile('logo')) {

                $image = $request->file('logo');
                $file_name = $image->getClientOriginalName();
    
                $setting->logo = $file_name;
    
                // move pic
                $imageName = $request->logo->getClientOriginalName();
                $request->logo->move(public_path('Attachments/' . $file_name), $file_name);
            }
        $setting->save();
     

        // return response()->json($setting);
    return $this->sendResponse($setting, 'setting Updated Successfully!' );
    }

  /**************************************************************************************/

    public function destroy($id)
    {
        $settings = Setting::find($id);

        $settings->delete();
        return $this->sendResponse($settings, 'settings deleted Successfully!' );
    }
}
