<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Slider;
use App\Files;

class SliderController extends Controller {

    /**
     * Administration view slider.
     *
     * @return Response
     */
    public function dashSlides(Slider $sliderModel, Files $filesModel)
    {

        $slides = $sliderModel->getSlides();
        $slides = $filesModel->get_files_with_size($slides);        
        return view('admin.slider.slider', ['slides' => $slides]);
    }
    /**
     * Create slide.
     *
     * @return Response
     */
    public function createSlide(Files $filesModel)
    {
        $images = $filesModel->getImages();
        return view('admin.slider.slide-create', ['images' => $images]);
    }
    public function handlerCreateSlide(Slider $sliderModel, Request $request)
    {
        $sliderModel->hcSlide($request);
        return redirect()->route('admin.slider.slider');
    }
    /**
     * Edit slide.
     *
     * @return Response
     */
    public function editSlide(Slider $sliderModel, $slug, Files $filesModel)
    {        
        $post = $sliderModel->scopeSlider($slug);
        $post = $filesModel->get_files_with_size($post);        
        return view('admin.slider.slide-edit', ['post' => $post]);
    }
    public function updateSlide(Slider $sliderModel, Files $filesModel, Request $request)
    {              
        if($request->files->has('images')){
            $request->files = $filesModel->insert_files($request->files->all()['images']);
        }       
        $sliderModel->updateSlide($request);
        return redirect()->route('admin.slider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
