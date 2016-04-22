<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Faqs;
use App\Files;
use App\Categories;
use Illuminate\Http\Request;

class FaqsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Faqs $faqsModel, Categories $categoriesModel, Files $filesModel)
    {
        $faqs = $faqsModel->getPublishedFaqs();
        $faqs = $filesModel->get_files_with_size($faqs);
        $cats = $categoriesModel->get_cats_parent('');
        return view('post.faqs', ['faqs' => $faqs, 'cats' => $cats]);
    }
    public function admin_loop(Faqs $faqsModel)
    {
        $faqs = $faqsModel->getAllFaqs();
        return view('admin.faqs.faqs', ['faqs' => $faqs]);
    }


    public function single(Faqs $faqsModel, $slug, Categories $categoriesModel, Files $filesModel)
    {
        $post = $faqsModel->scopeSingleFaq($slug);
        $cats = $categoriesModel->get_cats_parent('');
        $post = $filesModel->get_files_with_size($post);
        return view('post.faq', ['post' => $post, 'cats' => $cats]);
    }
    /**
     * Show the form for creating a faq resource.
     *
     * @return Response
     */
    public function create(Files $filesModel)
    {
        $images = $filesModel->getImages();
        return view('admin.faqs.faq-create', ['images' => $images]);
    }
    public function store(Files $filesModel, Faqs $faqsModel, Request $request)
    {
        if($request->files->has('images')){
            $request->files = $filesModel->insert_files($request->files->all()['images']);
        }
        $faqsModel->createFaq($request);
        return redirect()->route('admin.faqs.faqs');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Faqs $faqsModel, $slug, Files $filesModel)
    {
        $post = $faqsModel->scopeSingleFaq($slug);
        $post = $filesModel->get_files_with_size($post);
        return view('admin.faqs.faq-edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function  update(Files $filesModel, Faqs $faqsModel, Request $request)
    {
        if($request->files->has('images')){
            $request->files = $filesModel->insert_files($request->files->all()['images']);
        }
        $faqsModel->updateFaq($request);
        return redirect()->route('admin.faqs.faqs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Faqs $faqsModel, Request $request)
    {
        $faqsModel->deleteFaq($request);
        return redirect()->route('admin.faqs.faqs');
    }

}
