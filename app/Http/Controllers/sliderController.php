<?php

namespace App\Http\Controllers;
use App\Slider;
use Illuminate\Http\Request;
class sliderController extends Controller
{
    public function slider(){
        $sliders=Slider::all();
        return view('admin.slider.sliderUpload',compact('sliders'));
    }

      protected function create(Request $request)
    {
        $this->validate($request, [
                'image' =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/slider/' .'/image/' . $filename;
            $file->move(public_path() . "/slider/" ."/image/", $filename);
        }
        $slider = Slider::create([
            'image' => $path,

        ]);
        return redirect()->route('slider.add')->with('status', 'slider add successfully!');
    }
    public function delete(Slider $slider){
        $slider->delete();
        return redirect()->route('slider.add')->with('status', 'slider add successfully!');
    }
}

