<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class Slider extends Model {

    public function hcSlide($request)
    {
         if(isset($request->images)&&isset($request->files)){
            $images = array_merge($request->images, $request->files);
            $images = implode(",", $images);
        }
        elseif(isset($request->images)) {
            $images = implode(",", $request->images);
        }
        elseif(empty($request->files)) {
            $images = $request->files;
            $images = implode(",", $images);
        }
        else {
            $images = '';
        }        
        DB::table('sliders')->insert(
            array(
                'slug' => $request->slug,
                'title' => $request->title,
                'attr' => $request->attr,
                'images' => $images,
                'created_at' => Carbon::now('Europe/Moscow')->toDateTimeString(),
            ));
    }
    public function updateSlide($request)
    {        
         if(isset($request->images)&&isset($request->files)){
            $images = array_merge($request->images, $request->files);
            $images = implode(",", $images);
        }
        elseif(isset($request->images[0])) {
            $request->images = implode(",", $request->images);
        }
        elseif(empty($request->files)) {
            $images = $request->files;
            $images = implode(",", $images);
        }
        else {
            $request->images = '';
        }              
        DB::table('sliders')
            ->where('id', $request->id)
            ->update(array(                
                'title' => $request->title,
                'attr' => $request->attr,
                'images' => $request->images,               
            ));
    }
    public function getSlides()
    {
        $slides = Slider::latest('created_at')->get();
        return $slides;
    }
    public function scopeSlider($slug)
    {
        $slider = DB::table('sliders')->where('slug', $slug)->get();
        return $slider;
    }

}
