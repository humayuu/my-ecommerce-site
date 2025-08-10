<?php

namespace App\Http\Controllers\Backend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SliderController extends Controller
{
    // Function for Manage slider
    public function ManageSlider(){
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_view', compact('sliders'));

    }


    // Function for Store All Felids in Slider Table
    public function SliderStore(Request $request){
        $request->validate([
            'slider_img' => 'required',
        ]);

        if ($request->file('slider_img')) {

            // create image manager with desired driver
            $manager = new ImageManager(new Driver());

            $nameGen = hexdec(uniqid()) . '.' . $request->file('slider_img')->getClientOriginalExtension();

            // read image from file system
            $image = $manager->read($request->file('slider_img'));

            $image = $image->resize(870, 370);

            $image->toJpeg(80)->save(base_path('public/upload/slider/' . $nameGen));
            $saveUrl = 'upload/slider/' . $nameGen;

            Slider::insert([
                'title' => $request->title,
                'description' => $request->description,

                'slider_img' => $saveUrl
            ]);

            $notification = [
                'message' => 'Slider inserted Successfully',
                'alert-type' => 'success'
            ];

            return redirect()->back()->with($notification);
        }
    }

    // function for Edit Slider Data
    public function ManageEdit($id){
        $slider = Slider::findOrFail($id);
        return view('backend.slider.slider_edit', compact('slider'));
    }

    // Function for Update All Data
    public function SliderUpdate(Request $request){
        $sliderId  = $request->id;
        $oldImage = $request->old_image;

        if ($request->file('slider_img')) {
            unlink(base_path('public/' . $oldImage));
            // create image manager with desired driver
            $manager = new ImageManager(new Driver());

            $nameGen = hexdec(uniqid()) . '.' . $request->file('slider_img')->getClientOriginalExtension();

            // read image from file system
            $image = $manager->read($request->file('slider_img'));

            $image = $image->resize(870, 370);

            $image->toJpeg(80)->save(base_path('public/upload/slider/' . $nameGen));
            $saveUrl = 'upload/slider/' . $nameGen;

            Slider::findOrFail($sliderId)->update([
              'title' => $request->title,
              'description' => $request->description,
              'slider_img' => $saveUrl
            ]);


            $notification = [
                'message' => 'Slider Updated with Image Successfully',
                'alert-type' => 'info'
            ];

            return redirect()->route('manage-slider')->with($notification);

        } else {


            Slider::findOrFail($sliderId)->update([
                'title' => $request->title,
                'description' => $request->description
            ]);

            $notification = [
                'message' => 'Slider Updated without image Successfully',
                'alert-type' => 'info'
            ];

            return redirect()->route('manage-slider')->with($notification);


        }
    }

    // Function for Delete Slider
    public function SliderDelete($id){

        $slider = Slider::findOrFail($id);
        $image = $slider->slider_img;
        unlink($image);

        Slider::findOrFail($id)->delete();

        $notification = [
            'message' => 'Slider Deleted Successfully',
            'alert-type' => 'error'
        ];

        return redirect()->back()->with($notification);

    }



// Function for Update Status

public function SliderInactive($id){
    Slider::findOrFail($id)->update([
        'status' => 0
    ]);

    $notification = [
        'message' => 'Slider Inactive',
        'alert-type' => 'info'
    ];
    return redirect()->back()->with($notification);

}



public function SliderActive($id){
    Slider::findOrFail($id)->update([
        'status' => 1
    ]);

    $notification = [
        'message' => 'Slider Active',
        'alert-type' => 'info'
    ];
    return redirect()->back()->with($notification);
}



}
