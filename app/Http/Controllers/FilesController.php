<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Files;
use Illuminate\Http\Request;

class FilesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function upload()
    {
        return view('admin.files.file-upload');
    }
    public function submit(Files $filesModel, Request $request)
    {
        $filesModel->ajaxUpload($request);
        return redirect()->route('admin.files.images');
    }
    /**
     * Show all images in admin panel.
     */
    public function showImages(Files $filesModel)
    {
        $images = $filesModel->getImages();
        return view('admin.files.images', ['images' => $images]);
    }
    /**
     * Show all images in admin panel.
     */
    public function jqueryImages(Files $filesModel)
    {
        $images = $filesModel->getImages();
        return view('admin.files.jquery-images', ['images' => $images]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return Response
     */
    public function imgEdit (Files $filesModel, $slug)
    {
        $post = $filesModel->imgEdit($slug);
        return view('admin.files.image-edit', ['post' => $post]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function imgUpdate (Files $filesModel, Request $request)
    {
        $filesModel->updateImage($request);
        return redirect()->route('admin.files.images');
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


    public function create()
    {
        return view('admin.files.file-upload');
    }
    public function store(Files $filesModel, Request $request)
    {
        $filesModel->createFile($request);
        return redirect()->route('admin.files.images');
    }
    /**
     * Administration view slider.
     *
     * @return Response
     */
    public function dashSlider()
    {
        return view('admin.files.slider');
    }
    /**
     * Create slide.
     *
     * @return Response
     */
    public function createSlide(Files $filesModel)
    {
        $images = $filesModel->getImages();
        return view('admin.files.slide-create', ['images' => $images]);
    }
    public function handlerCreateSlide(Files $filesModel, Request $request)
    {
        $filesModel->hcSlide($request);
        return redirect()->route('admin.files.images');
    }
    public function dashSlides(Files $filesModel)
    {
        $slides = $filesModel->getSlides();
        return view('admin.files.slider', ['slides' => $slides]);
    }
    public function updateSlide()
    {
        return view('admin.files.images');
    }
    public function ajaxNotInImages(Files $filesModel, Request $request)
    {
        $images = $filesModel->ajaxNotInImages($request->imgs);        
        return response()->json($images);
    }




}
