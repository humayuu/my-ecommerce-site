<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SiteSettingController extends Controller
{
    public function SiteSetting()
    {
        $setting = SiteSetting::find(1);
        return view('backend.setting.setting_update', compact('setting'));
    }

    public function SiteSettingUpdate(Request $request, $id)
    {
        $settingId = $id;


        if ($request->file('logo')) {


            // create image manager with desired driver
            $manager = new ImageManager(new Driver());

            $nameGen = hexdec(uniqid()) . '.' . $request->file('logo')->getClientOriginalExtension();

            // read image from file system
            $image = $manager->read($request->file('logo'));

            $image = $image->resize(139, 36);

            $image->toJpeg(80)->save(base_path('public/upload/logo/' . $nameGen));
            $saveUrl = 'upload/logo/' . $nameGen;

            SiteSetting::findOrFail($settingId)->update([
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,
                'logo' => $saveUrl
            ]);

            $notification = [
                'message' => 'Brand Updated with Image Successfully',
                'alert-type' => 'info'
            ];

            return redirect()->back()->with($notification);
        } else {

            SiteSetting::findOrFail($settingId)->update([
                'phone_one' => $request->phone_one,
                'phone_two' => $request->phone_two,
                'email' => $request->email,
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'linkedin' => $request->linkedin,
                'youtube' => $request->youtube,


            ]);

            $notification = [
                'message' => 'Setting Updated Successfully',
                'alert-type' => 'info'
            ];

            return redirect()->back()->with($notification);
        }
    }


    public function SeoSetting()
    {

        $seo = Seo::find(1);
        return view('backend.setting.seo_update', compact('seo'));
    }

    public function SeoSettingUpdate(Request $request, $id)
    {
        Seo::findOrFail($id)->update([
            'meta_title' => $request->meta_title,
            'meta_author' => $request->meta_author,
            'meta_keyword' => $request->meta_keyword,
            'meta_description' => $request->meta_description,
            'google_analytics' => $request->google_analytics,

        ]);

        $notification = [
            'message' => 'Setting Updated Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->back()->with($notification);
    }
}
