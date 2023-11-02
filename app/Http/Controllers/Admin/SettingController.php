<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    function index()
    {
        $setting = Setting::first();
        return view('admin.settings.index', compact('setting'));
    }

    public function store(Request $request)
    {
        $setting = Setting::first();
        if ($setting) {
            $update_setting = $setting->update([
                "website_name" => $request->website_name,
                "website_url" => $request->website_url,
                "page_title" => $request->page_title,
                "meta_keyword" => $request->meta_keyword,
                "meta_description" => $request->meta_description,
                "address" => $request->address,
                "phone_1" => $request->phone_1,
                "phone_2" => $request->phone_2,
                "email_1" => $request->email_1,
                "email_2" => $request->email_2,
                "facebook" => $request->facebook,
                "twitter" => $request->twitter,
                "instagram" => $request->instagram,
                "youtube" => $request->youtube,
                "whatsapp" => $request->whatsapp,
            ]);
            if ($update_setting) {
                return redirect()->back()->with('success', 'Website Setting Updated Successfully');
            }
            return redirect()->back()->with('error', 'Someting went wrong while updating website setting');
        } else {
            $create_setting = Setting::create([
                "website_name" => $request->website_name,
                "website_url" => $request->website_url,
                "page_title" => $request->page_title,
                "meta_keyword" => $request->meta_keyword,
                "meta_description" => $request->meta_description,
                "address" => $request->address,
                "phone_1" => $request->phone_1,
                "phone_2" => $request->phone_2,
                "email_1" => $request->email_1,
                "email_2" => $request->email_2,
                "facebook" => $request->facebook,
                "twitter" => $request->twitter,
                "instagram" => $request->instagram,
                "youtube" => $request->youtube,
                "whatsapp" => $request->whatsapp,
            ]);
            if ($create_setting) {
                return redirect()->back()->with('success', 'Website Setting Created Successfully');
            }
            return redirect()->back()->with('error', 'Someting went wrong while creating website setting');
        }
    }
}
