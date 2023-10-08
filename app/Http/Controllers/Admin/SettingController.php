<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    
    public function index () {
        $data['settings'] = Setting::where('id', 1)->first();
        return view('admin.settings', $data);
    }

    public function update () {
        $settingsc = Setting::where('id', 1)->first();
        if (request()->has('file')) {
            $file = request()->file('file');
            $fileName = 'logo' . '.' . $file->getClientOriginalExtension();
            $filePath = public_path('/images/');
            $file->move($filePath, $fileName);
        } else {
            $fileName = $settingsc->logo;
        }


        $settings = Setting::where('id', 1)->first();

        $settings->appname = request('appname');
        $settings->appemail = request('appemail');
        $settings->currency = request('currency');
        $settings->mintprice = request('mintprice');
        $settings->sitelink = request('sitelink');
        $settings->emailnoreply = request('emailnoreply');
        $settings->mailfooter = request('mailfooter');
        $settings->logo = $fileName;
        $settings->save();
        
        return back()->with('msg', 'Saved Successfully');
    }
}
